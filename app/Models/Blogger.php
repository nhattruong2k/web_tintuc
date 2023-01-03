<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DanhMuc;
use App\Models\likeDislike;
use App\Models\User;
use App\Models\recentlyViewed;
use Carbon\Carbon;

class Blogger extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $dates = [
        'created_at','updated_at',
    ];
    protected $fillable = [
        'tenblog', 'tomtat','image',
        'kichhoat', 'slug_blog',
        'blog_noibat','views','content',
        'created_at','updated_at',
        'tagbaiviet','user_id','blog_province'
    ];

    public function thuocnhieudanhmucblog(){
        return $this->belongsToMany(DanhMuc::class, 'thuocdanhmucs','blog_id','danhmuc_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function likes(){
        return $this->hasMany(likeDislike::class);
    }
    public function vieweds(){
        return $this->hasMany(recentlyViewed::class);
    }

    public function province(){
        return $this->hasOne(Province::class,'id','blog_province');
    }

    public function scopeBlog($query){
        return $query->with('thuocnhieudanhmucblog','user','province')->orderBy('id','desc')->where('kichhoat', 1);
    }

    public function scopeDate_blog($query, $data){
        return $query->with('thuocnhieudanhmucblog','user')->orderBy('id','desc')->whereDate('created_at','>=', $data)->where('kichhoat', 1);
    }

    public function scopeMore_blog($query, $nhiublog){
        return $query->with('thuocnhieudanhmucblog','user')->orderBy('id','desc')->where('kichhoat', 1)->whereIn('id',$nhiublog);
    }

    public function scopeBlog_hot($query){
        return $query->with('thuocnhieudanhmucblog')->orderBy('id','desc')->where('kichhoat', 1)->where('blog_noibat',1)->orWhere('blog_noibat',0);
    }

    public function scopeSlug_blog($query, $slug){
        return $query->with('thuocnhieudanhmucblog','user')->where('slug_blog',$slug)->orderBy('id','desc')->where('kichhoat', 1);
    }
    
    public function scopeBlog_tag($query, $tag_baiviet){
        return $query->orderBy('id','desc')->Where('slug_blog','LIKE','%'. $tag_baiviet.'%')->where('kichhoat',1);
    }

}
