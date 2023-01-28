<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhMuc;
use App\Models\Thuocdanhmuc;
use App\Models\Blogger;
use App\Models\likeDislike;
use App\Models\User;
use Carbon\Carbon;
use  App\Http\Requests\Blog\StoreBlogRequest;
use App\Http\Requests\ManagerUser\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TestNotification;
use DB;
use App\Models\Comment;
use Illuminate\Support\Facades\Session;
use App\Helper;
use App\Models\recentlyViewed;
use ParagonIE\Sodium\Core\Curve25519\H;
use App\Models\Province;
use Illuminate\Support\Str;

class NewsController extends Controller
{

    public function wrap_search(Request $request){
        $val_keyword = $request->tenblog;
        $val_time = $request->time;
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        $day = $dt->subDay()->format("Y-m-d");
        $week = $dt->subWeek()->format("Y-m-d");
        $month = $dt->subMonth()->format("Y-m-d");
        $val_category = $request->category;
        $content_type = $request->content_type;
        $result = Blogger::query()->where('kichhoat',1);

        if(!empty($content_type) && $content_type != 'all'){
            $result = $result->where($content_type, 'like', "%{$val_keyword}%");      
        }else{
            $result = $result->where('tenblog', 'like', "%{$val_keyword}%")->Orwhere('tomtat', 'like', "%{$val_keyword}%")->Orwhere('author', 'like', "%{$val_keyword}%");
        }
        // Datetime
        if(!empty($val_time)) {
            if($val_time == "day"){
                $result = $result->whereDate('created_at','>=', $day);
            }elseif($val_time == "week"){
                $result = $result->whereDate('created_at','>=', $week);
            }elseif($val_time == "month"){
                $result = $result->whereDate('created_at','>=', $month);
            }
        }
        // Category
        if (!empty($val_category) && $val_category != "all"){ 
            $result = $result->where('slug_cateParent', $val_category);            
        }
        $search_blog = $result->paginate(5);


        $nav_cate = DanhMuc::Nav_cate()->get();
        $danhmuc = DanhMuc::Parent_cate()->get();
        $province = Province::whereIn('name', ['Thành phố Hà Nội', 'Thành phố Hồ Chí Minh'])->get();
        foreach($province as $provinces){
            $str = $provinces->name;
            $provinces->slug_name = str_replace("thanh-pho-","",slugify($str));
        }
        foreach($search_blog as $blog){
            $str = $blog->user->name;
            $blog->tacgia_slug = slugify($str);
        }

        return view('pages.multiple_search')->with(compact('nav_cate','province','danhmuc','val_keyword','search_blog'));
    }

    public function tim_kiem(Request $request){
        if($request->ajax())
        {
            $query = $request->get('query');
            if($query != ''){
                $data = Blogger::Blog()->where('tenblog', 'LIKE', "%{$query}%")->get();
            }else{
                $data = Blogger::Blog()->get();
            }

            $output = '<div class="resultsContent" style="width: 270px; height: 305px; overflow: auto">
            ';
            foreach($data as $row)
            {
                // public/uploads/blog/
               $route_blog = route('bai_viet',['slug'=> $row->slug_blog]);
               $output .= '
               <div class="item-ult">
                    <div class="row">
                        <div class="col-9">
                            <div class="title">
                                <a href="'.$route_blog.'">'.$row->tenblog.'</a>
                                <p class="tacgia">Tác giả: '.$row->user->name.'</p>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="thumbs">
                                <a href="'.$route_blog.'">
                                    <img class="img_blog" src="'.url('public/uploads/blog/'.$row->image.'').'" style="height: 55px;">
                                    </img>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
               ';
            }

           $output .= ' </div>';
        //    echo $output;
        }
        return response()->json($output);
    }

    public function home_new(){
        $danhmuc = DanhMuc::Parent_cate()->get();
        $nav_cate = DanhMuc::Nav_cate()->get();
        $danhmuc_check = DanhMuc::Child_cate()->get();
        $danhparent_blog_id = [];
        $danhchild_blog_id = [];
        foreach($danhmuc_check as $muc){
            if(count($muc->nhieublog)!=0){
                if($muc->parent_id==0){
                    array_push($danhparent_blog_id,$muc->id);
                }else{
                    array_push($danhchild_blog_id,$muc->parent_id);
                }
            };
        }
        $danh_blog = array_merge($danhparent_blog_id,$danhchild_blog_id);
        $danh_blog = array_unique($danh_blog);
        $danh_blog = DanhMuc::Child_cate()->whereIn('id',$danh_blog)->get();
        // dd($danh_blog);
        $array_blog = [];
        foreach($danh_blog as $danh){
            foreach($danh->nhieublog as $blog){
                $array_blog[] = array_push($array_blog,$blog->id);
            }
        }

        $blog_hot = Blogger::Blog_hot()->get();
        $blogger = Blogger::Blog()->get();
        // $recentBlog = recentlyViewed::with('blog')->orderBy('id','desc')->take(4)->get();

        $province = Province::whereIn('name', ['Thành phố Hà Nội', 'Thành phố Hồ Chí Minh'])->get();
        
        foreach($blogger as $blog){
            $str = $blog->user->name;
            $blog->tacgia_slug = slugify($str);
        }
        
        foreach($blog_hot as $blog){
            $str = $blog->user->name;
            $blog->tacgia_slug = slugify($str);
        }
        foreach($danh_blog as $danh){
            foreach($danh->nhieublog as $blog){
                $str = $blog->user->name;
                $blog->tacgia_slug = slugify($str);
            }
            foreach($danh->children as $danh_children){
                foreach($danh_children->nhieublog as $blog_chil){
                    $str = $blog_chil->user->name;
                    $blog_chil->tacgia_slug = slugify($str);
                }
            }
        }
        foreach($province as $provinces){
            $str = $provinces->name;
            $provinces->slug_name = str_replace("thanh-pho-","",slugify($str));
        }
       return view('pages.home')->with(compact('nav_cate','danh_blog','danhmuc','blogger','blog_hot','array_blog','province'));
    }
    
    public function blog_province($blog_province){
        $danhmuc = DanhMuc::Parent_cate()->get();
        $nav_cate = DanhMuc::Nav_cate()->get();
        $province = Province::whereIn('name', ['Thành phố Hà Nội', 'Thành phố Hồ Chí Minh'])->get();
        $blogger = Blogger::Blog()->where('slug_province',$blog_province)->paginate(8);
        foreach($province as $provinces){
            $str = $provinces->name;
            $provinces->slug_name = str_replace("thanh-pho-","",slugify($str));
            $provinces->name_province = substr( str_replace("Thành phố","",$str), 1);
        }

        foreach($blogger as $blog){
            $str = $blog->province->name;
            $str1 = $blog->user->name;
            $blog->slug_blogProvince = str_replace("thanh-pho-","",slugify($str));
            $blog->tacgia_slug = slugify($str1);
            $blog->province_blog = substr( str_replace("Thành phố","",$str), 1);
        }
        // dd($blog_province);

        return view('pages.blogProvince')->with(compact('nav_cate','danhmuc','province','blogger','blog_province'));
    }

    public function livewire(){
        return view('livewire');
    }

    public function tin_tuc24h(){
        $danhmuc = DanhMuc::Parent_cate()->get();
        $blog_hot = Blogger::Blog_hot()->get();
        $nav_cate = DanhMuc::Nav_cate()->get();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data = Carbon::now();
        $data->subDay();
        $data->format("Y-m-d");
        $posts = Blogger::Date_blog($data)->paginate(5);
        // dd($posts);
        $province = Province::whereIn('name', ['Thành phố Hà Nội', 'Thành phố Hồ Chí Minh'])->get();

        foreach($posts as $blog){
            $str = $blog->user->name;
            $blog->tacgia_slug = slugify($str);
        }
        foreach($blog_hot as $blog){
            $str = $blog->user->name;
            $blog->tacgia_slug = slugify($str);
        }
        foreach($province as $provinces){
            $str = $provinces->name;
            $provinces->slug_name = str_replace("thanh-pho-","",slugify($str));
        }
        return view('pages.tintuc_24h')->with(compact('nav_cate','danhmuc','blog_hot','posts','province'));
    }

    public function danh_muc($slug){
        $danhmuc = DanhMuc::Parent_cate()->get();
        $nav_cate = DanhMuc::Nav_cate()->get();
        $danhmuc_id = DanhMuc::Caterogy($slug)->first();
        $danhmuc_parent = DanhMuc::Caterogy($slug)->first();
        $danhmuc_blog = DanhMuc::find($danhmuc_id->id);
        $nhiublog = [];
        foreach($danhmuc_blog->nhieublog as $danh){
            $nhiublog[] = $danh->id;
        }
        $province = Province::whereIn('name', ['Thành phố Hà Nội', 'Thành phố Hồ Chí Minh'])->get();

        $tendanh = $danhmuc_id;
        $blogger = Blogger::Blog()->whereIn('id',$nhiublog)->paginate(8);
        foreach($province as $provinces){
            $str = $provinces->name;
            $provinces->slug_name = str_replace("thanh-pho-","",slugify($str));
        }
        foreach($blogger as $blog){
            $str = $blog->user->name;
             $blog->tacgia_slug = slugify($str);
        }
        return view('pages.category')->with(compact('nav_cate','danhmuc','blogger','tendanh','slug', 'danhmuc_id', 'danhmuc_parent','province'));
    }

    public function danh_muc2($slug_parent, $slug){
        $danhmuc = DanhMuc::Parent_cate()->get();
        $nav_cate = DanhMuc::Nav_cate()->get();
        $danhmuc_id = DanhMuc::Caterogy($slug)->first();
        $danhmuc_parent = DanhMuc::Category2($danhmuc_id)->first();
        // dd($danhmuc_parent);
        $danhmuc_blog = DanhMuc::find($danhmuc_id->id);
        $nhiublog = [];
        foreach($danhmuc_blog->nhieublog as $danh){
            $nhiublog[] = $danh->id;
        }
        $tendanh = $danhmuc_id;
        $blogger = Blogger::More_blog($nhiublog)->paginate(8);
        $province = Province::whereIn('name', ['Thành phố Hà Nội', 'Thành phố Hồ Chí Minh'])->get();
    
        foreach($blogger as $blog){
            $str = $blog->user->name;
            $blog->tacgia_slug = slugify($str);
        }
        foreach($province as $provinces){
            $str = $provinces->name;
            $provinces->slug_name = str_replace("thanh-pho-","",slugify($str));
        }
        return view('pages.category')->with(compact('nav_cate','danhmuc','blogger','tendanh','slug', 'danhmuc_id', 'danhmuc_parent','province'));
    }

    public function bai_viet($slug){
        $danhmuc = DanhMuc::Parent_cate()->get();
        $blog_hot = Blogger::Blog_hot()->get();
        $nav_cate = DanhMuc::Nav_cate()->get();
        // dd($blog_hot);
        $province = Province::whereIn('name', ['Thành phố Hà Nội', 'Thành phố Hồ Chí Minh'])->get();

        $baiviet = Blogger::Slug_blog($slug)->first();

        $recentBlog = recentlyViewed::Recen_view()->get();

        $nhiublog = [];
        foreach($baiviet->thuocnhieudanhmucblog as $danh){
            $nhiublog[] = $danh->id;
        }
        // Lấy ra những blog có cùng danh mục
        $cungdanhmuc = DanhMuc::Same_Cate($nhiublog)->get(); 
        
        // Like bài viết
        $like = likeDislike::Count_Like($baiviet)->count();
        $user = new User();
        $like_count = likeDislike::where('user_id',$user )->where('blog_id', $baiviet)->count();
        $comment = Comment::Com($baiviet)->get(); 
        $countComments = Comment::Count_com($baiviet)->count(); 
        
        // set session for recently_vieweds
        if(empty(Session::get('session_id'))){
            $session_id = md5(uniqid(rand(), true));
        }else{
            $session_id = Session::get('session_id');
        }
        Session::put('session_id', $session_id);

        // Insert recently_vieweds
        if(Auth::user()){
            $coutRecentlyVieweds = DB::table('recently_vieweds')->where(['user_id'=>auth()->user()->id,'blog_id'=>$baiviet->id, 'session_id'=>$session_id])->count();
            // echo $coutRecentlyVieweds; 
            if($coutRecentlyVieweds==0){
                DB::table('recently_vieweds')->insert(['user_id'=>auth()->user()->id, 'blog_id'=>$baiviet->id, 'session_id'=>$session_id, 'created_at'=>Carbon::now(), 'updated_at'=>now()]);
            }
        }
        $baiviet->tacgia_slug = slugify($baiviet->user->name);
        foreach($blog_hot as $blog){
            $blog->tacgia_slug = slugify($blog->user->name);
        }
        foreach($cungdanhmuc as $danh){
            foreach($danh->nhieublog as $nhieubaiviet){
                $nhieubaiviet->tacgia_slug = slugify($nhieubaiviet->user->name);  
            }
        }
        foreach($province as $provinces){
            $provinces->slug_name = str_replace("thanh-pho-","",slugify($provinces->name));
        }
        return view('pages.blog')->with(compact('nav_cate','blog_hot','comment','countComments','danhmuc','baiviet','cungdanhmuc','like','like_count','recentBlog','province'));
    }

    public function recentViewed(){
        $danhmuc = DanhMuc::Parent_cate()->get();
        $nav_cate = DanhMuc::Nav_cate()->get();
        $province = Province::whereIn('name', ['Thành phố Hà Nội', 'Thành phố Hồ Chí Minh'])->get();
        foreach($province as $provinces){
            $provinces->slug_name = str_replace("thanh-pho-","",slugify($provinces->name));
        }
        return view('pages.recentView')->with(compact('nav_cate','danhmuc','province'));
    }
    
    public function view(Request $request){
        $blog_id = $request['blog_id'];
        $sessionKey = 'blog_' . $blog_id;
        $sessionView = Session::get($sessionKey);
        $checkBlog = Blogger::findOrFail($blog_id);
        if(!$sessionView){
            Session::put($sessionKey, 1);
            $checkBlog->increment('views');
        }
    }
    
    public function tacgia($slug){
        $danhmuc = DanhMuc::Parent_cate()->get();
        $blogger = Blogger::Blog()->get();
        $nav_cate = DanhMuc::Nav_cate()->get();
        $province = Province::whereIn('name', ['Thành phố Hà Nội', 'Thành phố Hồ Chí Minh'])->get();

        foreach($blogger as $blog){
             $blog->tacgia_slug = slugify($blog->user->name);
        }
        $blog_slug = $blogger->where('tacgia_slug',$slug);
         foreach($blog_slug as $blog_2){
            $tacgia = $blog_2->user->name;
         }
         foreach($province as $provinces){
            $provinces->slug_name = str_replace("thanh-pho-","",slugify($provinces->name));
        }
        return view('pages.tacgia')->with(compact('nav_cate','danhmuc','blog_slug','tacgia','province'));
    }

    public function save_likeDislike(Request $request){
        $like = 0;
        $blog_id = $request['blogId'];

        $checkLike = likeDislike::Like($blog_id)->first();
        // dd($checkLike);
        if($checkLike){
            $checkLike->delete();
            $like = likeDislike::Like1($blog_id)->count();
            // dd($like);
        }else{
            likeDislike::create([
                'user_id' => Auth::user()->id,
                'blog_id' => $blog_id,
                'like'=> 1,
            ]);
            $like = likeDislike::Like1($blog_id)->count();
        }
        return $like;
    }

    public function tag_baiviet(Request $request, $tag_baiviet){
        $danhmuc = DanhMuc::Parent_cate()->get();
        $baiviet_tag = Blogger::Blog_tag($tag_baiviet)->get();
        $nav_cate = DanhMuc::Nav_cate()->get();
        $province = Province::whereIn('name', ['Thành phố Hà Nội', 'Thành phố Hồ Chí Minh'])->get();

        foreach($baiviet_tag as $tag){
             $tag->tacgia_slug = slugify($tag->user->name);
        }
        foreach($province as $provinces){
            $provinces->slug_name = str_replace("thanh-pho-","",slugify($provinces->name));
        }
        return view('pages.tag')->with(compact('nav_cate','danhmuc','tag_baiviet','baiviet_tag','province'));
    }   
 
    public function thembaiviet(){
        $danhmuc = DanhMuc::Parent_cate()->get();
        $nav_cate = DanhMuc::Nav_cate()->get();
        $danhmuc_baiviet = DanhMuc::Child_cate()->get();
        $province = Province::whereIn('name', ['Thành phố Hà Nội', 'Thành phố Hồ Chí Minh'])->get();
        foreach($province as $provinces){
            $provinces->slug_name = str_replace("thanh-pho-","",slugify($provinces->name));
        }
        return view('pages.baiviet')->with(compact('nav_cate','danhmuc','danhmuc_baiviet','province'));
    }
    
    public function cate_blog(Request $request){
        $query = $request->get('cate_id');
        $data = DanhMuc::orderBy('id','desc')->where('parent_id',$query)->get();
        $slug_cate = DanhMuc::orderBy('id','desc')->where('id',$query)->get();
        // dd($slug_cate);
        $output = '<label for="">Danh muc con</label><br>
        <div class="form-check-inline">';
        foreach($slug_cate as $slug_cates){
            $output .='
                <input class="form-check-input" name="slug_cateParent" type="hidden" value="'.$slug_cates->slug_danhmuc.'">
            ';
        };
        foreach($data as $val){
            $output .= '<div style="margin: 0px 5px 0px 5px;;">
            <input class="form-check-input" name="danhmuc[]" type="checkbox" id="danhmuc_'.$val->id.'" value="'.$val->id.'">
                <label class="form-check-label" for="danhmuc_'.$val->id.'" style="font-size:15px; color:black">'.$val->tendanhmuc.'</label>
            </div>
            ';
        };
        
        $output .= '</div>';
        // dd( $output);
        return response()->json($output);
    }

    public function province_blog(Request $request){
        $query = $request->get('province_id');
        $data = Province::where('id',$query)->get();
        $output = '<div>
        <label for="exampleInputEmail1">Slug khu vực: </label><br>
        ';
        foreach($data as $da){
            $slug_data = $da->slug_name = str_replace("thanh-pho-","",slugify($da->name));
            $output .='
                <input type="hidden" name="slug_province" value="'.$slug_data.'">  
            ';
        }
        $output .= '</div><br>';
        return response()->json($output);
    }
    public function luubaiviet(StoreBlogRequest $request){
        $blog = new Blogger(); 
        $blog->fill($data = $request->all());
        $blog->slug_blog = $data['slug_blog'];
        $get_image = $request->image;
        $path = 'public/uploads/blog/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image )); //Lấy tên hình ảnh gắn định dạng 
        $new_image = $name_image.rand (0,99).'.'.$get_image->getClientOriginalExtension(); //Trả về đuôi mở rộng của file
        $get_image->move($path, $new_image);
        $blog->image = $new_image;
        $blog->blog_province = $request->blog_province;
        if($request->slug_province != null){
            $blog->slug_province=$data['slug_province'];
        }else{
            $blog->slug_province= null;
        }
        $blog->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $blog->save();
        $blog->thuocnhieudanhmucblog()->attach($data['danhmuc']);
        // dd($blog);
        return redirect('/post/create')->with('success', 'Thêm blog thành công');
    }

    public function dele_account(Request $request){
        $data = $request->only('email','password');
        $check_login = Auth::attempt($data);
        if($check_login){
            $user = User::find(Auth::user()->id);
            $user->delete();
            return response()->json(['data'=> $user]);
        };  
    }
    
    public function profileUser(){
        $danhmuc = DanhMuc::Parent_cate()->get();
        $user = User::findOrFail(auth()->user()->id);
        $nav_cate = DanhMuc::Nav_cate()->get();
        $user_province = User::user_province($user)->get();
        $user_district = User::user_district($user)->get();
        $user_ward = User::user_ward($user)->get();
        $userAddress = [];
        $userAddress = [
            "province" => $user_province,
            "district" => $user_district,
            "ward" => $user_ward,
        ];
        $province = Province::whereIn('name', ['Thành phố Hà Nội', 'Thành phố Hồ Chí Minh'])->get();
        foreach($province as $provinces){
            $provinces->slug_name = str_replace("thanh-pho-","",slugify($provinces->name));
        }
        return view('pages.profileUser')->with(compact('nav_cate','user', 'userAddress','danhmuc','province'));
    }

    public function storeProfile(UpdateUserRequest $request){
        $user = User::find(auth()->user()->id);
        $data = $request->all();

        $get_image = $request->avatar;
        // dd($get_image);
        if($get_image)
        {
            $path = 'public/uploads/user/'.$user->avatar;
            if(file_exists($path)){
                unlink($path);
            }
        $path = 'public/uploads/user/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image )); //Lấy tên hình ảnh gắn định dạng 
        $new_image = $name_image.rand (0,99).'.'.$get_image->getClientOriginalExtension(); //Trả về đuôi mở rộng của file
        $get_image->move($path, $new_image);
        $user->avatar = $new_image;
        }
        $user->update($data);
        return redirect()->back()->with('success', 'Thêm user thành công');
    }

    public function password(){
        $danhmuc = DanhMuc::Parent_cate()->get();
        $pass = User::find( auth()->user()->id );
        $nav_cate = DanhMuc::Nav_cate()->get();
        $province = Province::whereIn('name', ['Thành phố Hà Nội', 'Thành phố Hồ Chí Minh'])->get();
        foreach($province as $provinces){
            $provinces->slug_name = str_replace("thanh-pho-","",slugify($provinces->name));
        }
        return view('pages.password')->with(compact('nav_cate','danhmuc','pass','province'));
    }
    
    public function updatePassword(Request $request){
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Mật khẩu hiện tại của bạn không khớp với mật khẩu bạn đã cung cấp. Vui lòng thử lại.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","Mật khẩu mới không được giống với mật khẩu hiện tại của bạn. Vui lòng chọn một mật khẩu khác.");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ],
        [
            'current-password' => 'Bắt buộc phải có',
            'new-password.min' => 'Ít nhất có 6 ký tự',
            'new-password.confirmed' => 'Xác nhận mật khẩu mới không khớp.',
        ]
        );
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success","Mật khẩu đã thay đổi thành công !");
    }

    public function notifications(){
        $danhmuc = DanhMuc::Parent_cate()->get();
        $nav_cate = DanhMuc::Nav_cate()->get();
        $province = Province::whereIn('name', ['Thành phố Hà Nội', 'Thành phố Hồ Chí Minh'])->get();
        foreach($province as $provinces){
            $provinces->slug_name = str_replace("thanh-pho-","",slugify($provinces->name));
        }
        return view('pages.thongbao')->with(compact('nav_cate','danhmuc','province'));
    }

    public function insert_noti(Request $request){
        $request->validate([
                'email' => 'required',
                'title' => 'required',
                'content' => 'required'
            ],
            [
                'email.required' => 'Email không được để trống',
                'title.required' => 'Tiêu đề không được để trống',
                'content.required' => 'Nội dung không để trống',
            ]
        );
        $data['email'] = $request->input('email');
        $data['title'] = $request->input('title');
        $data['content'] = $request->input('content');
        $user = User::first();
        Notification::send($user,new TestNotification($data));
         // dd($user->notifications);
         return redirect()->back()->with('success', 'Thêm thông báo thành công');
    }
}
