<?php

namespace App\Http\Controllers;

use App\Models\Blogger;
use App\Models\DanhMuc;
use Illuminate\Http\Request;
use App\Models\Thuocdanhmuc;
use Illuminate\Support\Carbon;
use  App\Http\Requests\Blog\StoreBlogRequest;
use App\Http\Requests\Blog\UpdateBlogRequest;
use App\Models\Province;

class BloggerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('permission:add articles|add category',['only' => ['create','store']]);
        $this->middleware('permission:edit articles|edit category',['only'=>['edit','update']]);
        $this->middleware('permission:delete articles|delete category',['only'=>'destroy']);
    }

    public function index()
    {
        $list_blog = Blogger::with(['thuocnhieudanhmucblog'])->orderBy('id', 'DESC')->get();
        
        return view('admin.blog.index')->with(compact('list_blog'));
    }

    
    public function kichhoat(Request $request){ 
        // dd($request->all());
        $baiviet_kichoat =  Blogger::find($request->blog_id);

        $baiviet_kichoat->kichhoat = $request->kichhoat;
        $baiviet_kichoat->save();
        return response()->json(['success'=>'Status change successfully.']);
    }       
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $danhmuc = DanhMuc::Parent_cate()->get();
        $blog_province = Province::whereIn('name', ['Thành phố Hà Nội', 'Thành phố Hồ Chí Minh'])->get();
        return view('admin.blog.create')->with(compact('danhmuc','blog_province'));
    }

    public function blog_province(Request $request){
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


    public function cate_blog(Request $request){
        $query = $request->get('cate_id');
        $data = DanhMuc::orderBy('id','desc')->where('parent_id',$query)->get();
        $slug_cate = DanhMuc::orderBy('id','desc')->where('id',$query)->get();
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
            <label class="form-check-label" for="danhmuc_'.$val->id.'">'.$val->tendanhmuc.'</label>
            </div>
            ';
        };
        
        $output .= '</div>';
        // dd( $output);
        return response()->json($output);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogRequest $request)
    {
        $blog = new Blogger(); 
        $blog->fill($data = $request->all());
        // dd($blog);
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
        return redirect('blog')->with('success', 'Thêm blog thành công');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blogger  $blogger
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blogger::with('thuocnhieudanhmucblog','province')->findOrFail($id);
        // dd($blog);
        $tacgia= Blogger::with('user')->findOrFail($id);
        return view('admin.blog.view')->with(compact('blog','tacgia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blogger  $blogger
     * @return \Illuminate\Http\Response
     */
    public function edit(Blogger $blogger, $id)
    {
        $blog = Blogger::with('user','province')->find($id);
        if($blog->province != null){
            $blog_provinceId = $blog->province->id; 
        }else{
            $blog_provinceId = ""; 
        }
        $blog_province = Province::whereIn('name', ['Thành phố Hà Nội', 'Thành phố Hồ Chí Minh'])->get();
        $thuocdanhmuc = $blog->thuocnhieudanhmucblog;
        // echo $thuocdanhmuc;
        $danhmuc = DanhMuc::Parent_cate()->get();
    
        return view('admin.blog.edit')->with(compact('blog','thuocdanhmuc','danhmuc','blog_province','blog_provinceId'));
    }

    public function edit_blogProvince(Request $request){
        $query = $request->get('province_id'); 
        if($query != 0){
            $data = Province::where('id',$query)->get();
        }elseif($query == 0){
            $data = null;
        }
        $output = '<div>
        <label for="exampleInputEmail1">Slug khu vực: </label><br>
        ';
        if($query != 0){
            foreach($data as $da){
                $slug_data = $da->slug_name = str_replace("thanh-pho-","",slugify($da->name));
                $output .='
                    <input type="text" name="slug_province" value="'.$slug_data.'">  
                ';
            }
        }elseif($query == 0){
            $output .='
                <input type="text" name="slug_province" value="'.$data.'">  
            ';
        }
        $output .= '</div>
        <br>';
        return response()->json($output);
     }

    public function edit_cate_blog(Request $request){
        $blog_id = $request->get('blog_id');
        $blog = Blogger::find($blog_id);
        $thuocdanhmuc = $blog->thuocnhieudanhmucblog;
        $array_cate = [];
        foreach($thuocdanhmuc as $thuoc){
           array_push($array_cate, $thuoc->id);
        }
        $query = $request->get('cate_id');
        if($query == 0 ){
            $data = null;
        }else{
            $data = DanhMuc::orderBy('id','desc')->where('parent_id',$query)->get();
            $slug_cate = DanhMuc::orderBy('id','desc')->where('id',$query)->get();
        }

        $output = '<label for="">Danh muc con</label><br>
        <div class="form-check-inline">
        ';
        if($query == 0){
            $output .='
                <input type="hidden" name="slug_cateParent" value="'.$data.'">
            ';
        }else{
            foreach($slug_cate as $slug_cates){
                $check_parent = in_array($slug_cates->id,$array_cate) ? 'checked="checked"' : '';
                $output .='
                    <input class="form-check-input" '.$check_parent.' name="slug_cateParent" type="hidden" value="'.$slug_cates->slug_danhmuc.'">
                ';
            };
            foreach($data as $val){
                $check = in_array($val->id,$array_cate) ? 'checked="checked"' : '';
                $output .= '<div style="margin: 0px 5px 0px 5px;">
                <input class="form-check-input" '.$check.'
                
                name="danhmuc[]" type="checkbox" id="danhmuc_'.$val->id.'" value="'.$val->id.'">
    
                <label class="form-check-label" for="danhmuc_'.$val->id.'">'.$val->tendanhmuc.'</label>
                </div>
                ';    
            }
        }
        $output .= '</div>';
        // dd( $output);
        return response()->json( $output);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blogger  $blogger
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogRequest $request, $id)
    {
        $blog = Blogger::find($id);
        $blog->fill($data = $request->all());
        $blog->blog_noibat = $data['blog_noibat'];
        $blog->thuocnhieudanhmucblog()->sync($data['danhmuc']);
        if($request->blog_province == 0 ){
            $blog->blog_province = null;
        }
        $get_image = $request->image;
        if($get_image)
        {
            $path = 'public/uploads/blog/'.$blog->image;
            if(file_exists($path)){
                unlink($path);
            }
        $path = 'public/uploads/blog/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image )); //Lấy tên hình ảnh gắn định dạng 
        $new_image = $name_image.rand (0,99).'.'.$get_image->getClientOriginalExtension(); //Trả về đuôi mở rộng của file
        $get_image->move($path, $new_image);
        $blog->image = $new_image;
        }
        $blog->blog_province=$data['blog_province'];
        if($request->slug_province != null){
            $blog->slug_province=$data['slug_province'];
        }else{
            $blog->slug_province= null;
        }
        $blog->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        // dd($blog);
        $blog->save();
        return redirect('blog')->with('success', 'Cập nhật blog thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blogger  $blogger
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blogger $blogger,$id)
    {
        $blog = Blogger::find($id);
        $path = 'public/blogger/'.$blog->image;
        if(file_exists($path)){
            unlink($path);
        }
        $blog->thuocnhieudanhmucblog()->detach($blog->danhmuc_id); 
        Blogger::find($id)->delete();
        // dd($bl);
        return response()->json($blog);
    }

    public function content_detail($id){
        return Blogger::findOrFail($id);
        // dd($blog);
    }
}
