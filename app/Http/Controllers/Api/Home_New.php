<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DanhMuc;
use App\Models\Blogger;
use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS;
use Carbon\Carbon;
use App\Models\Comment;
use App\Models\likeDislike;
use App\Models\User;
use App\Models\recentlyViewed;
use Illuminate\Support\Facades\Auth;
use DB;

class Home_New extends Controller
{
    public function tim_kiem(Request $request){
            if($request->get('query')){
                $query = $request->get('query');
                $data = Blogger::with('user')->where('tenblog', 'LIKE', "%{$query}%")->where('kichhoat',1)->get();
            }
            die (json_encode(array('data'=>$data,), 200));
    }

    public function menu(){
        $danhmuc = DanhMuc::with('children')->orderBy('id','desc')->where('parent_id','0')->where('kichhoat', 1)->take(4)->get();
        die (json_encode(array('danhmuc'=>$danhmuc), 200));
    }


    public function more_modalMenu(){
        $danhmuc = DanhMuc::with('children')->orderBy('id','desc')->where('parent_id','0')->where('kichhoat', 1)->get();
        die (json_encode(array('danhmuc'=>$danhmuc), 200));
    }

    public function list_banner(){
        $blog = Blogger::orderBy('id','desc')->select('image','tenblog','slug_blog')->where('kichhoat', 1)->get();
        die (json_encode(array('blog'=>$blog), 200));
    }

    public function list_singleBlog(){
        $singleBlog =  Blogger::with('thuocnhieudanhmucblog')->orderBy('id','desc')->where('kichhoat', 1)->take(6)->get();
        function slugify0($str) { 
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
        foreach($singleBlog as $blog){
            $blog->tacgia_slug = slugify($blog->user->name);
       }
        die (json_encode(array('singleBlog'=>$singleBlog), 200));
    }
    
    public function list_danhBlog(){

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
        function slugify1($str) { 
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
        foreach($danh_blog as $danh){
            foreach($danh->nhieublog as $blog){
                $blog->tacgia_slug = slugify1($blog->user->name);
            }
            foreach($danh->children as $danh_children){
                foreach($danh_children->nhieublog as $blog_chil){
                    $blog_chil->tacgia_slug = slugify1($blog_chil->user->name);
                }
            }
        }
        die (json_encode(array('danh_blog'=>$danh_blog), 200));
    }

    public function list_blogHot(){
        $blogHot = Blogger::with('thuocnhieudanhmucblog')->orderBy('id','desc')->where('kichhoat', 1)->where('blog_noibat',1)->get();
        die (json_encode(array('blogHot'=>$blogHot), 200));
    }
   
    public function list_blogviews(){
        $blogView = Blogger::with('thuocnhieudanhmucblog')->orderBy('id','desc')->where('kichhoat', 1)->where('views','>',2)->get();
        die (json_encode(array('blogView'=>$blogView), 200));
    }

    public function list_blogfilter(){
        $blog = Blogger::with('thuocnhieudanhmucblog')->orderBy('id','desc')->where('kichhoat', 1)->get();
        function slugify2($str) { 
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
        foreach($blog as $blogs){
            $blogs->tacgia_slug = slugify2($blogs->user->name);
       }
        die (json_encode(array('blog'=>$blog), 200));
    }

    public function tin_tuc24h(){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        // $dt = Carbon::create(2018, 10, 18, 14, 40, 16);
        // dd($dt);
        $data = Carbon::now();
        $data->subDay();
        $data->format("Y-m-d");
        $posts = Blogger::orderBy('id','desc')->whereDate('created_at','>=', $data)->where('kichhoat', 1)->paginate(1);
        function slugify3($str) { 
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
            $blog->tacgia_slug = slugify3($blog->user->name);
       }
        die (json_encode(array('posts'=>$posts), 200));

    }

    public function danhmuc($slug){
        $danhmuc_id = DanhMuc::where('slug_danhmuc', $slug)->with('children')->first();
        
        $danhmuc_blog = DanhMuc::find($danhmuc_id->id);
        $nhiublog = [];
        foreach($danhmuc_blog->nhieublog as $danh){
            $nhiublog[] = $danh->id;
        }
        
        $blogger = Blogger::with('thuocnhieudanhmucblog')->orderBy('id', 'DESC')->where('kichhoat', 1)->whereIn('id',$nhiublog)->get();
        function slugify4($str) { 
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
             $blog->tacgia_slug = slugify4($blog->user->name);
        }
        die (json_encode(array('blogger'=>$blogger, 'slug'=>$slug, 'danhmuc_id'=>$danhmuc_id), 200));
    }

    public function danhmuc_parent($slug_parent, $slug){
        $danhmuc_id = DanhMuc::where('slug_danhmuc', $slug)->with('children')->first();
        $danhmuc_parent = DanhMuc::where('id', $danhmuc_id->parent_id)->with('children')->first();
        $danhmuc_blog = DanhMuc::find($danhmuc_id->id);
        $nhiublog = [];
        foreach($danhmuc_blog->nhieublog as $danh){
            $nhiublog[] = $danh->id;
        }
        $blogger = Blogger::with('thuocnhieudanhmucblog')->orderBy('id', 'DESC')->where('kichhoat', 1)->whereIn('id',$nhiublog)->get();
        function slugify5($str) { 
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
             $blog->tacgia_slug = slugify5($blog->user->name);
        }
        die (json_encode(array('blogger'=>$blogger, 'slug'=>$slug, 'danhmuc_id'=>$danhmuc_id,'danhmuc_parent'=>$danhmuc_parent), 200));
    }

    public function bai_viet($slug_baiviet){
        $baiviet = Blogger::with('thuocnhieudanhmucblog')->where('slug_blog',$slug_baiviet)->where('kichhoat', 1)->first();
    
        function slugify6($str) { 
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
        $baiviet->tacgia_slug = slugify6($baiviet->user->name);  
        die (json_encode(array('baiviet'=>$baiviet), 200));
    }

    public function relate_blog($baiviet_relate){
        $baiviet = Blogger::with('thuocnhieudanhmucblog')->where('slug_blog',$baiviet_relate)->where('kichhoat', 1)->first();
        $nhiublog = [];
        foreach($baiviet->thuocnhieudanhmucblog as $danh){
            $nhiublog[] = $danh->id;
        }
        $cungdanhmuc = DanhMuc::with('nhieublog')->where('id',$nhiublog)->take(3)->get(); 
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
        foreach($cungdanhmuc as $danh){
            foreach($danh->nhieublog as $nhieubaiviet){
                $nhieubaiviet->tacgia_slug = slugify($nhieubaiviet->user->name);  
            }
        }
        die (json_encode(array('cungdanhmuc'=>$cungdanhmuc), 200));
    }

    public function comment_baiviet($baiviet_comment){
        $baiviet = Blogger::with('thuocnhieudanhmucblog')->where('slug_blog',$baiviet_comment)->where('kichhoat', 1)->first();
        $comment = Comment::with('replies')->orderBy('id','desc')->where('blog_id', $baiviet->id)->where('reply_id','=',0)->where('kichhoat','=',0)->get(); 
        $countComments = Comment::where('blog_id', $baiviet->id)->count(); 
        die (json_encode(array('comment'=>$comment, 'countComments'=>$countComments), 200));
    }

    public function like_baiviet($like_baiviet){
        $baiviet = Blogger::with('thuocnhieudanhmucblog')->where('slug_blog',$like_baiviet)->where('kichhoat', 1)->first();
        $like = likeDislike::where('blog_id', $baiviet->id)->where('like',1)->count();
        die (json_encode(array('like'=>$like), 200));
    }

    public function tag($slug_tag){
        $baiviet_tag = Blogger::orderBy('id','desc')->Where('slug_blog','LIKE','%'. $slug_tag.'%')->where('kichhoat',1)->get();
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
        die (json_encode(array('baiviet_tag'=>$baiviet_tag), 200));
    }

    public function tacgia($username){
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
        $blog_slug = $blogger->where('tacgia_slug',$username);
        foreach($blog_slug as $blog_2){
        $tacgia = $blog_2->user->name;
        }
        die (json_encode(array('blog_slug'=>$blog_slug, 'tacgia'=>$tacgia), 200));

    }

    public function recentViewed(){
        $user = auth()->user()->id; 
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data = Carbon::now();
        $data->subWeek();
        $data->format("Y-m-d");
        $recentBlog = recentlyViewed::with('blog','user')->orderBy('id','desc')->where('user_id',$user)->whereDate('created_at','>',$data)->get();
        
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
       die (json_encode(array('recentBlog'=>$recentBlog), 200));
    }
}
