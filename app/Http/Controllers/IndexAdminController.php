<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Blogger;
use App\Models\Comment;
use App\Models\likeDislike;
use Illuminate\Support\Facades\DB as FacadesDB;

class IndexAdminController extends Controller
{
    public function index(){
        $list_blog = Blogger::orderby('id','desc')->get();
        // dd($blog_hot);
        $list_user = User::orderby('id','desc')->get();
        $list_like = likeDislike::orderby('id','desc')->get();
        $count_blog =  $list_blog->count();
        $count_user =  $list_user->count();
        $count_like = $list_like->count();
        $count_comments = Comment::count();
        $comment_parents = Comment::where('reply_id',0)->where('kichhoat','=',0)->count();
        $phantramcomments = round(($comment_parents*100)/$count_comments);
        // dd(round($phantramcomments));
        $count_notifi = FacadesDB::table('notifications')->count();
        return view('admin.dashboard.index')->with(compact('count_blog','count_user','count_notifi','count_like','count_comments','phantramcomments'));
    }

}
