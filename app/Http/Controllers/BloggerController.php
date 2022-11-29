<?php

namespace App\Http\Controllers;

use App\Models\Blogger;
use App\Models\DanhMuc;
use Illuminate\Http\Request;
use App\Models\Thuocdanhmuc;
use Illuminate\Support\Carbon;
use  App\Http\Requests\Blog\StoreBlogRequest;
use App\Http\Requests\Blog\UpdateBlogRequest; 
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
        $danhmuc = DanhMuc::orderBy('id','desc')->where('kichhoat', 1)->get();
        return view('admin.blog.create')->with(compact('danhmuc'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogRequest $request)
    {
        // dd($request->all());
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

        // foreach($data['danhmuc'] as $key=>$danh){
        //     $blog->danhmuc_id = $danh[0];
        // }
        $blog->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $blog->save();
        $blog->thuocnhieudanhmucblog()->attach($data['danhmuc']);
        // dd($blog);
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
        $blog = Blogger::with('thuocnhieudanhmucblog',)->findOrFail($id);
        $tacgia= Blogger::with('user')->findOrFail($id);
        // dd($tacgia);
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
        $blog = Blogger::with('user')->find($id);
        $thuocdanhmuc = $blog->thuocnhieudanhmucblog;
        $danhmuc = DanhMuc::orderBy('id','desc')->where('kichhoat', 1)->get();
        // dd($danhmuc);
        return view('admin.blog.edit')->with(compact('blog','thuocdanhmuc','danhmuc'));
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
        $blog->blog_noibat = $data['blognoibat'];

        $blog->thuocnhieudanhmucblog()->sync($data['danhmuc']);

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
        return redirect()->back()->with('success', 'Xóa blog thành công');
    }

    public function content_detail($id){
        return Blogger::findOrFail($id);
        // dd($blog);
    }
}
