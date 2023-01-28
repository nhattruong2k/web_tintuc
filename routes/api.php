<?php

use Facade\FlareClient\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Home_New;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group([ 'prefix' => 'auth' ], function(){
//     Route::post('/login', [AuthController::class,'login'])->name('login');
//     Route::post('/register', [AuthController::class,'register'])->name('register');

//     Route::group(['middleware'=>'auth:api'], function(){
//         Route::delete('logout', [AuthController::class,'logout'])->name('logout');
//         Route::get('user', [AuthController::class,'user'])->name('user');
//         Route::get('/tin-da-doc',[Home_New::class,'recentViewed'])->name('recentViewed');

//     });
// });

// Route::get('/menu', [Home_New::class, 'menu'])->name('menu');
// Route::get('/more-modalMenu', [Home_New::class, 'more_modalMenu'])->name('more_modalMenu');
// Route::get('/list-banner', [Home_New::class, 'list_banner'])->name('list_banner');
// Route::get('/list-singleBlog', [Home_New::class, 'list_singleBlog'])->name('list_singleBlog');
// Route::get('/list-danhBlog', [Home_New::class, 'list_danhBlog'])->name('list_danhBlog');
// Route::get('/list-blogHot', [Home_New::class, 'list_blogHot'])->name('list_blogHot');
// Route::get('/list-blogviews', [Home_New::class, 'list_blogviews'])->name('list_blogviews');
// Route::get('/list-blogfilter', [Home_New::class, 'list_blogfilter'])->name('list_blogfilter');
// Route::get('/tin-tuc24h', [Home_New::class, 'tin_tuc24h'])->name('tin_tuc24h');
// Route::get('/tim-kiem',[Home_New::class, 'tim_kiem'])->name('tim_kiem');
// Route::get('bai-viet/{slug_baiviet}', [Home_New::class, 'bai_viet'])->name('bai_viet');
// Route::get('tag/{slug_tag}',[Home_New::class, 'tag'])->name('tag');
// Route::get('tac-gia/{username}',[Home_New::class, 'tacgia'])->name('tacgia');
// Route::get('relate-blog/{baiviet_relate}', [Home_New::class, 'relate_blog'])->name('relate_blog');
// Route::get('comment/{baiviet_comment}', [Home_New::class, 'comment_baiviet'])->name('comment_baiviet');
// Route::get('like/{like_baiviet}', [Home_New::class, 'like_baiviet'])->name('like_baiviet');
// Route::get('/{slug}', [Home_New::class, 'danhmuc'])->name('danhmuc');
// Route::get('{slug_parent}/{slug}',[Home_New::class, 'danhmuc_parent'])->name('danhmuc_parent');
// Route::group(['middleware'=>'auth'], function(){
//     Route::get('/tin-da-doc',[Home_New::class,'recentViewed'])->name('recentViewed');
// });