<?php

use App\Http\Controllers\IndexAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserPremissionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\ManagerUserController;
use PhpOffice\PhpSpreadsheet\Calculation\Category;
use App\Http\Controllers\DanhMucController;
use  App\Http\Controllers\BloggerController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SendNotification;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\Auth\CommentLoginController;
use App\Http\Controllers\BlogViewController;
use App\Http\Controllers\TestEmailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/register',[RegisterController::class,'index']);

Route::get('/location/provinces', [LocationController::class, 'getProvinces'])->name('getProvinces');
Route::get('/location/province/{province}/districts', [LocationController::class, 'getDistricts'])->name('getDistricts');
Route::get('/location/district/{district}/wards', [LocationController::class, 'getWards'])->name('getWards');
Route::get('/testEmail',[TestEmailController::class, 'email']);

Route::group(['middleware' =>['auth','role:admin']], function(){
    Route::post('/export-csv',[DanhMucController::class,'export_csv']);
    Route::post('/import-csv',[DanhMucController::class,'import_csv']);
    
    Route::get('/see-like', [LikeController::class, 'like'])->name('see-like'); 
    Route::get('/staff_user', [ManagerUserController::class,'staff_user'])->name('staff_user');
    Route::get('/phan-vaitro/{id}', [ManagerUserController::class, 'phanvaitro'])->name('vaitro');
    Route::get('/accept-role',  [ManagerUserController::class, 'accept_role']);
    Route::post('/insert_navbar',  [DanhMucController::class, 'insert_navbar'])->name('insert_navbar');

    // Route::get('/phan-quyen/{id}', [UserPremissionController::class, 'phanquyen']);
    Route::get('/phanquyen/{id}', [UserPremissionController::class, 'quyen'])->name('phanquyen');

    Route::post('/insert_roles/{id}', [ManagerUserController::class, 'insert_roles']);    
    Route::post('/insert_permission/{id}', [UserPremissionController::class, 'insert_permission']);

    Route::post('/delete_role/{id}', [UserPremissionController::class, 'delete_role'])->name('delete_role');
    Route::post('/extra_role', [UserPremissionController::class, 'extra_role'])->name('extra_role');
    Route::post('/axtra-permission', [UserPremissionController::class, 'axtra_permission'])->name('axtra_permission');  
    Route::resource('/userpermission', UserPremissionController::class);
    Route::get('/profileAdmin',[AdminController::class,'profileAdmin'])->name('profileAdmin');
    Route::resource('/admin', AdminController::class);
    Route::resource('/manager_user', ManagerUserController::class);
    Route::get('/showPassword/{id}/changPass', [AdminController::class,'showPassword'])->name('showPassword');
    Route::put('/resetPassword/{id}', [AdminController::class,'resetPassword'])->name('resetPassword');
    Route::resource('/user', UserController::class);
    // Admin
    Route::get('/profileAdmin',[AdminController::class,'profileAdmin'])->name('profileAdmin');
    Route::get('/changePasswordAdmin',[AdminController::class,'showChangePassword']);
    Route::post('/changePasswordAdmin',[AdminController::class,'changePassword'])->name('changePasswordAdmin');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('index_notification', [SendNotification::class,'index'])->name('notification.index');
    Route::delete('deletenotification/{id}',[SendNotification::class,'destroy'])->name('deletenotification.destroy');
    Route::put('notification/{id}',[SendNotification::class,'update'])->name('notification.update');

    Route::post('/notification/get', [NotificationController::class,'get']);
    Route::post('/index_notification/read', [NotificationController::class,'read']);
    Route::get('list-comment',[CommentController::class,'list_comment'])->name('comment.list');
    Route::post('list-comment',[CommentController::class,'update_comment'])->name('comment.update');

});

Route::group(['middleware'=>['auth','role:admin|publisher|writer|editer|deleter']], function(){
    Route::resource('/blog', BloggerController::class);
    Route::post('blog/cate_blog', [BloggerController::class,'cate_blog'])->name('cate_blog');
    Route::post('blog/blog_province', [BloggerController::class,'blog_province'])->name('blog.blog_province');
    Route::post('blog/edit_blogProvince', [BloggerController::class,'edit_blogProvince'])->name('edit_blogProvince');
    Route::post('blog/edit_cate_blog', [BloggerController::class,'edit_cate_blog'])->name('edit_cate_blog');
    Route::get('content_detail/{id}',[BloggerController::class,'content_detail']);
    Route::post('/kichhoat', [BloggerController::class,'kichhoat']);
    Route::resource('/danhmuc', DanhMucController::class);
    Route::post('/kichhoatdanhmuc', [DanhMucController::class,'kichhoat']);
    Route::get('/admin', [IndexAdminController::class,'index']);
    Route::get('notification', [SendNotification::class,'create'])->name('notification.create');
    Route::post('postnotification',[SendNotification::class,'store'])->name('postnotification.store');
});

Route::group(['middleware'=>['auth','role:blogger']], function(){
    Route::get('/post/create',[NewsController::class,'thembaiviet']);
    Route::post('/post/store',[NewsController::class,'luubaiviet'])->name('post.store');
    Route::post('/post/cate_blog',[NewsController::class,'cate_blog'])->name('post.cate_blog');
    Route::post('/post/province_blog',[NewsController::class,'province_blog'])->name('post.province_blog');
});

Route::group(['middleware'=>'auth','role:blogger|viewer'], function(){
    Route::get('/profile',[NewsController::class,'profileUser'])->name('profileUser');
    Route::post('/profile',[NewsController::class,'storeProfile'])->name('storeProfile');
    Route::get('/password',[NewsController::class,'password'])->name('password');
    Route::post('/password',[NewsController::class,'updatePassword'])->name('updatePass');
    Route::get('/notifications',[NewsController::class,'notifications'])->name('notifications');
    Route::post('/notifications',[NewsController::class,'insert_noti'])->name('insert_noti');
    Route::get('/like/{id}', function(){
        return redirect('/login');
    })->name('like');
    Route::post('/save-likeDislike',[NewsController::class, 'save_likeDislike'])->name('save.likeDislike');
});

Route::group(['middleware'=>'auth'], function(){
    Route::get('/tin-da-doc',[NewsController::class,'recentViewed'])->name('recentViewed');
});

Route::group(['prefix'=>'comment'], function(){
    Route::post('/login',[CommentLoginController::class,'login'])->name('comment.login');
    Route::get('/logout',[CommentLoginController::class,'logout'])->name('comment.logout');
    // Route::post('/login-google',[CommentLoginController::class,'login_google'])->name('comment.login_google');
    Route::post('/register', [CommentLoginController::class,'register'])->name('comment.register');
    Route::post('/comment-binhluan/{blog_id}',[CommentController::class,'binhluan'])->name('comment.binhluan');

});


Route::get('/redirect-goole', [SocialController::class,'redirectGoogle'])->name('redirectGoogle');
Route::get('/google_callback', [SocialController::class,'processGoogleLogin']);
Route::get('home-new', [NewsController::class,'home_new'])->name('home_new');
Route::get('/livewire',[NewsController::class,'livewire'])->name('livewire');
Route::get('/tin-tuc-24h', [NewsController::class,'tin_tuc24h'])->name('tuc24h');
Route::post('/view',[NewsController::class,'view'])->name('view');
Route::get('tim-kiem', [NewsController::class,'tim_kiem'])->name('tim_kiem');
Route::post('dele_account', [NewsController::class,'dele_account'])->name('dele_account');
Route::get('wrap_search', [NewsController::class,'wrap_search'])->name('wrap_search');
Route::get('ajax_mulSearch', [NewsController::class,'ajax_mulSearch'])->name('ajax_mulSearch');
Route::get('/topic/{blog_province}', [NewsController::class, 'blog_province'])->name('blog_province');

Route::get('home-new/{slug}', [NewsController::class,'danh_muc'])->name('category');
Route::get('home-new/{slug_parent}/{slug}', [NewsController::class,'danh_muc2'])->name('category22');
Route::get('{slug}', [NewsController::class,'bai_viet'])->name('bai_viet');
Route::get('tag/{tag_baiviet}', [NewsController::class,'tag_baiviet'])->name('tagbaiviet');
// Comment 
Route::get('tac-gia/{slug}', [NewsController::class,'tacgia'])->name('tacgia');