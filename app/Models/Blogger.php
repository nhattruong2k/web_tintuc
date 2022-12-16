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
        'tagbaiviet','user_id',
    ];

    // public function danhmuc(){
    //     return $this->belongsTo(DanhMuc::class, 'danhmuc_id', 'id');
    // }
    public function thuocnhieudanhmucblog(){
        return $this->belongsToMany(DanhMuc::class, 'thuocdanhmucs','blog_id','danhmuc_id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function likes(){
        return $this->hasMany(likeDislike::class);
    }
    public function vieweds(){
        return $this->hasMany(recentlyViewed::class);
    }

    public function province(){
        return $this->hasOne(Province::class,'id','news_region_id');
    }
    // // Dislikes
    // public function dislikes(){
    //     return $this->hasMany(likeDislike::class,'blog_id')->sum('dislike');
    // }
}
