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

class NewsController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('role:blogger|viewer',['only' => ['thembaiviet','luubaiviet',
    //                                                         'profileUser','storeProfile',
    //                                                         'password','updatePassword',
    //                                                         'notifications','insert_noti']]);
    // }
  
    public function tim_kiem(Request $request){
        if($request->get('query'))
        {
            $query = $request->get('query');

            $data = Blogger::with('user')->where('tenblog', 'LIKE', "%{$query}%")->where('kichhoat',1)->get();

            $output = '<div class="resultsContent" style="width: 333px; height: 305px; overflow: auto; border-radius: 3%">
                <span class="box-triangle">
                    <svg viewBox="0 0 20 9" role="presentation">
                        <path d="M.47108938 9c.2694725-.26871321.57077721-.56867841.90388257-.89986354C3.12384116 6.36134886 5.74788116 3.76338565 9.2467995.30653888c.4145057-.4095171 1.0844277-.40860098 1.4977971.00205122L19.4935156 9H.47108938z" fill="#ffffff"></path>
                    </svg>
                </span>
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
                                    <img class="img_blog" src="'.url('public/uploads/blog/'.$row->image.'').'">
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
        $danhmuc = DanhMuc::with('children','nhieublog')->orderBy('id','desc')->where('parent_id','0')->where('kichhoat', 1)->get();
        
        $danhmuc_check = DanhMuc::with('children','nhieublog')->orderBy('id','desc')->where('kichhoat', 1)->get();
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
        $danh_blog = DanhMuc::with('children','nhieublog')->orderBy('id','desc')->whereIn('id',$danh_blog)->where('kichhoat', 1)->get();
        // dd($danh_blog);
        $array_blog = [];
        foreach($danh_blog as $danh){
            foreach($danh->nhieublog as $blog){
                $array_blog[] = array_push($array_blog,$blog->id);
            }
        }

        $blog_hot = Blogger::with('thuocnhieudanhmucblog')->orderBy('id','desc')->where('kichhoat', 1)->where('blog_noibat',1)->orWhere('blog_noibat',0)->get();
        $blogger = Blogger::with('thuocnhieudanhmucblog','user')->orderBy('id','desc')->where('kichhoat', 1)->get();      
        // $recentBlog = recentlyViewed::with('blog')->orderBy('id','desc')->take(4)->get();

        function slugify($str) { 
            $str = trim(mb_strtolower($str)); 
            $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str); 
            $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str); 
            $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str); 
            $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str); 
            $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str); 
            $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str); 
            $str = preg_replace('/(đ)/', 'd', $str); 
            $str = preg_replace('/[^a-z0-9-\s]/', '', $str); 
            $str = preg_replace('/([\s]+)/', '-', $str); 
        return $str; 
        }
        foreach($blogger as $blog){
                $blog->tacgia_slug = slugify($blog->user->name);
        }
    
        foreach($danh_blog as $danh){
            foreach($danh->nhieublog as $blog){
                $blog->tacgia_slug = slugify($blog->user->name);
            }
            foreach($danh->children as $danh_children){
                foreach($danh_children->nhieublog as $blog_chil){
                    $blog_chil->tacgia_slug = slugify($blog_chil->user->name);
                }
            }
        }
        // echo $danh_blog;
       return view('pages.home')->with(compact('danh_blog','danhmuc','blogger','blog_hot','array_blog'));
    }
    
    public function livewire(){
        return view('livewire');
    }

    public function tin_tuc24h(){
        $danhmuc = DanhMuc::with('children')->orderBy('id','desc')->where('parent_id','0')->where('kichhoat', 1)->get();
        $blogger = Blogger::with('thuocnhieudanhmucblog')->orderBy('id','desc')->where('kichhoat', 1)->get();
        $blog_hot = Blogger::with('thuocnhieudanhmucblog')->orderBy('id','desc')->where('kichhoat', 1)->get();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        // $dt = Carbon::create(2018, 10, 18, 14, 40, 16);
        // dd($dt);
        $data = Carbon::now();
        $data->subDay();
        $data->format("Y-m-d");
        $posts = Blogger::orderBy('id','desc')->whereDate('created_at','>=', $data)->where('kichhoat', 1)->paginate(5);
        function slugify($str) { 
            $str = trim(mb_strtolower($str)); 
            $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str); 
            $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str); 
            $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str); 
            $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str); 
            $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str); 
            $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str); 
            $str = preg_replace('/(đ)/', 'd', $str); 
            $str = preg_replace('/[^a-z0-9-\s]/', '', $str); 
            $str = preg_replace('/([\s]+)/', '-', $str); 
        return $str; 
        }

        foreach($posts as $blog){
             $blog->tacgia_slug = slugify($blog->user->name);
        }
        
        return view('pages.tintuc_24h')->with(compact('danhmuc','blogger','blog_hot','posts'));
    }

    public function danh_muc($slug){
        $danhmuc = DanhMuc::orderBy('id','desc')->where('parent_id','0')->with('children')->where('kichhoat', 1)->get();
        $danhmuc_id = DanhMuc::where('slug_danhmuc', $slug)->with('children')->first();
        $danhmuc_parent = DanhMuc::where('slug_danhmuc', $slug)->with('children')->first();
        $danhmuc_blog = DanhMuc::find($danhmuc_id->id);
        $nhiublog = [];
        foreach($danhmuc_blog->nhieublog as $danh){
            $nhiublog[] = $danh->id;
        }
        
        $tendanh = $danhmuc_id;
        $blogger = Blogger::with('thuocnhieudanhmucblog')->orderBy('id', 'DESC')->where('kichhoat', 1)->whereIn('id',$nhiublog)->get();
        function slugify($str) { 
            $str = trim(mb_strtolower($str)); 
            $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str); 
            $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str); 
            $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str); 
            $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str); 
            $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str); 
            $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str); 
            $str = preg_replace('/(đ)/', 'd', $str); 
            $str = preg_replace('/[^a-z0-9-\s]/', '', $str); 
            $str = preg_replace('/([\s]+)/', '-', $str); 
        return $str; 
        }

        foreach($blogger as $blog){
             $blog->tacgia_slug = slugify($blog->user->name);
        }
        return view('pages.category')->with(compact('danhmuc','blogger','tendanh','slug', 'danhmuc_id', 'danhmuc_parent'));
    }

    public function danh_muc2($slug_parent, $slug){
        $danhmuc = DanhMuc::orderBy('id','desc')->where('parent_id','0')->with('children')->where('kichhoat', 1)->get();
        $danhmuc_id = DanhMuc::where('slug_danhmuc', $slug)->with('children')->first();
        $danhmuc_parent = DanhMuc::where('id', $danhmuc_id->parent_id)->with('children')->first();
        // dd($danhmuc_parent);
        $danhmuc_blog = DanhMuc::find($danhmuc_id->id);
        $nhiublog = [];
        foreach($danhmuc_blog->nhieublog as $danh){
            $nhiublog[] = $danh->id;
        }
        $tendanh = $danhmuc_id;
        $blogger = Blogger::with('thuocnhieudanhmucblog')->orderBy('id', 'DESC')->where('kichhoat', 1)->whereIn('id',$nhiublog)->get();
        function slugify($str) { 
            $str = trim(mb_strtolower($str)); 
            $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str); 
            $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str); 
            $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str); 
            $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str); 
            $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str); 
            $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str); 
            $str = preg_replace('/(đ)/', 'd', $str); 
            $str = preg_replace('/[^a-z0-9-\s]/', '', $str); 
            $str = preg_replace('/([\s]+)/', '-', $str); 
        return $str; 
        }

        foreach($blogger as $blog){
             $blog->tacgia_slug = slugify($blog->user->name);
        }
        return view('pages.category')->with(compact('danhmuc','blogger','tendanh','slug', 'danhmuc_id', 'danhmuc_parent'));
    }

    public function bai_viet($slug){
        $danhmuc = DanhMuc::orderBy('id','desc')->where('parent_id','0')->with('children')->where('kichhoat', 1)->get();
        $blog_hot = Blogger::with('thuocnhieudanhmucblog')->orderBy('id','desc')->where('kichhoat', 1)->get();
        $blogger = Blogger::with('thuocnhieudanhmucblog')->orderBy('id','desc')->where('kichhoat', 1)->get();
        $baiviet = Blogger::with('thuocnhieudanhmucblog')->where('slug_blog',$slug)->where('kichhoat', 1)->first();
        // dd($baiviet->id);
        $recentBlog = recentlyViewed::with('blog')->orderBy('id','desc')->take(2)->get();

        $nhiublog = [];
        foreach($baiviet->thuocnhieudanhmucblog as $danh){
            $nhiublog[] = $danh->id;
        }
        // Lấy ra những blog có cùng danh mục
        $cungdanhmuc = DanhMuc::with('nhieublog')->where('id',$nhiublog)->take(3)->get(); 
        
        // Like bài viết
        $like = likeDislike::where('blog_id', $baiviet->id)->where('like',1)->count();
        $user = new User();
        $like_count = likeDislike::where('user_id',$user )->where('blog_id', $baiviet)->count();
        $comment = Comment::with('replies')->orderBy('id','desc')->where('blog_id', $baiviet->id)->where('reply_id','=',0)->where('kichhoat','=',0)->get(); 
        
        $countComments = Comment::where('blog_id', $baiviet->id)->count(); 
        
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

        function slugify($str) { 
            $str = trim(mb_strtolower($str)); 
            $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str); 
            $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str); 
            $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str); 
            $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str); 
            $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str); 
            $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str); 
            $str = preg_replace('/(đ)/', 'd', $str); 
            $str = preg_replace('/[^a-z0-9-\s]/', '', $str); 
            $str = preg_replace('/([\s]+)/', '-', $str); 
        return $str; 
        }
        $baiviet->tacgia_slug = slugify($baiviet->user->name);  
        foreach($cungdanhmuc as $danh){
            foreach($danh->nhieublog as $nhieubaiviet){
                $nhieubaiviet->tacgia_slug = slugify($nhieubaiviet->user->name);  
            }
        }

        return view('pages.blog')->with(compact('blog_hot','comment','countComments','danhmuc','blogger','baiviet','cungdanhmuc','like','like_count','recentBlog'));
    }

    public function recentViewed(){
        $danhmuc = DanhMuc::orderBy('id','desc')->where('parent_id','0')->with('children')->where('kichhoat', 1)->get();
        $user = User::find(auth()->user()->id);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        // dd($dt);
        $data = Carbon::now();
        $data->subWeek();
        $data->format("Y-m-d");
        $recentBlog = recentlyViewed::with('blog','user')->orderBy('id','desc')->where('user_id',$user->id)->whereDate('created_at','>',$data)->get();
        function slugify_blogger($str) { 
            $str = trim(mb_strtolower($str)); 
            $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str); 
            $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str); 
            $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str); 
            $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str); 
            $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str); 
            $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str); 
            $str = preg_replace('/(đ)/', 'd', $str); 
            $str = preg_replace('/[^a-z0-9-\s]/', '', $str); 
            $str = preg_replace('/([\s]+)/', '-', $str); 
        return $str; 
        }
        foreach($recentBlog as $blog){
            $blog->tacgia_slug = slugify_blogger($blog->user->name);
       }
        return view('pages.recentView')->with(compact('danhmuc','recentBlog'));
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
        $danhmuc = DanhMuc::orderBy('id','desc')->where('parent_id','0')->with('children')->where('kichhoat', 1)->get();
        $blogger = Blogger::orderBy('id','desc')->get();
        function slugify_blogger($str) { 
            $str = trim(mb_strtolower($str)); 
            $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str); 
            $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str); 
            $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str); 
            $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str); 
            $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str); 
            $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str); 
            $str = preg_replace('/(đ)/', 'd', $str); 
            $str = preg_replace('/[^a-z0-9-\s]/', '', $str); 
            $str = preg_replace('/([\s]+)/', '-', $str); 
        return $str; 
        }
        foreach($blogger as $blog){
             $blog->tacgia_slug = slugify_blogger($blog->user->name);
        }
        $blog_slug = $blogger->where('tacgia_slug',$slug);
         foreach($blog_slug as $blog_2){
            $tacgia = $blog_2->user->name;
         }
        return view('pages.tacgia')->with(compact('danhmuc','blog_slug','tacgia'));
    }

    public function save_likeDislike(Request $request){
        $like = 0;
        $blog_id = $request['blogId'];

        $checkLike = likeDislike::where('user_id', Auth::user()->id)->where('blog_id', $blog_id)->first();
        // dd($checkLike);
        if($checkLike){
            $checkLike->delete();
            $like = likeDislike::where('blog_id', $blog_id)->count();
            // dd($like);
        }else{
            likeDislike::create([
                'user_id' => Auth::user()->id,
                'blog_id' => $blog_id,
                'like'=> 1,
            ]);
            $like = likeDislike::where('blog_id', $blog_id)->count();
        }
        return $like;
    }


    public function tag_baiviet(Request $request, $tag_baiviet){
        $danhmuc = DanhMuc::orderBy('id','desc')->where('parent_id','0')->with('children')->where('kichhoat', 1)->get();
        // $slug = Str::slug($request->tag_baiviet);
        $baiviet_tag = Blogger::orderBy('id','desc')->Where('slug_blog','LIKE','%'. $tag_baiviet.'%')->where('kichhoat',1)->get();
        function slugify_tag($str) { 
            $str = trim(mb_strtolower($str)); 
            $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str); 
            $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str); 
            $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str); 
            $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str); 
            $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str); 
            $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str); 
            $str = preg_replace('/(đ)/', 'd', $str); 
            $str = preg_replace('/[^a-z0-9-\s]/', '', $str); 
            $str = preg_replace('/([\s]+)/', '-', $str); 
        return $str; 
        }
        foreach($baiviet_tag as $tag){
             $tag->tacgia_slug = slugify_tag($tag->user->name);
        }
        return view('pages.tag')->with(compact('danhmuc','tag_baiviet','baiviet_tag'));
    }
// 
    public function thembaiviet(){
        $danhmuc = DanhMuc::orderBy('id','desc')->where('parent_id','0')->with('children')->where('kichhoat', 1)->get();
        $danhmuc_baiviet = DanhMuc::orderBy('id','desc')->where('kichhoat', 1)->get();
        return view('pages.baiviet')->with(compact('danhmuc','danhmuc_baiviet'));
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

        $blog->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $blog->save();
        $blog->thuocnhieudanhmucblog()->attach($data['danhmuc']);
        // dd($blog);
        return redirect('/post/create')->with('success', 'Thêm blog thành công');
    }

    public function profileUser(){
        $danhmuc = DanhMuc::orderBy('id','desc')->where('parent_id','0')->with('children')->where('kichhoat', 1)->get();
        $user = User::findOrFail(auth()->user()->id);
        $user_province = User::with('province')->where('province_id',$user->province_id)->get();
        $user_district = User::with('district')->where('district_id',$user->district_id)->get();
        $user_ward = User::with('ward')->where('ward_id',$user->ward_id)->get();
        $userAddress = [];
        $userAddress = [
            "province" => $user_province,
            "district" => $user_district,
            "ward" => $user_ward,
        ];
        return view('pages.profileUser')->with(compact('user', 'userAddress','danhmuc'));
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
        $danhmuc = DanhMuc::orderBy('id','desc')->where('parent_id','0')->with('children')->where('kichhoat', 1)->get();
        $pass = User::find( auth()->user()->id );
        return view('pages.password')->with(compact('danhmuc','pass'));
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
        $danhmuc = DanhMuc::orderBy('id','desc')->where('parent_id','0')->with('children')->where('kichhoat', 1)->get();
        return view('pages.thongbao')->with(compact('danhmuc'));
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
