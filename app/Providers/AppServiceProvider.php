<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Blogger;
use App\Models\likeDislike;
use App\Models\Comment;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */

    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view){
            $list_blog = Blogger::orderby('id','desc')->get();
            $list_user = User::orderby('id','desc')->get();
            $list_like = likeDislike::orderby('id','desc')->get();
            $count_blog =  $list_blog->count();
            $count_user =  $list_user->count();
            $count_like = $list_like->count();
            $count_notifi = FacadesDB::table('notifications')->count();
            $count_comments = Comment::count();
            $comment_parents = Comment::where('reply_id',0)->where('kichhoat','=',0)->count();
            $view->with(compact('count_blog', 'count_user', 'count_notifi','count_like','count_comments'));
        });
        Carbon::setLocale('vi');
        Paginator::useBootstrap();
        // $dt = Carbon::create(2018, 10, 18, 14, 40, 16);
        // $dt2 = Carbon::create(2018, 10, 18, 13, 40, 16);
        // echo  $dt2->diffForHumans($dt); // 1 giờ trước
    }
}
