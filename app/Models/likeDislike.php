<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS;

class likeDislike extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'user_id','blog_id','like'
    ];
    // public function blog(){
    //     return $this->belongsTo(Blogger::class);
    // }
    protected $primaryKey = 'id';
    protected $table = 'like_dislikes';

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function blog(){
        return $this->belongsTo(Blogger::class);
    }

    public function scopeLike($query, $blog_id){
        return $query->where('user_id', Auth::user()->id)->where('blog_id', $blog_id);
    }

    public function scopeLike1($query, $blog_id){
        return $query->where('blog_id', $blog_id);
    }

    public function scopeCount_Like($query, $baiviet){
        return $query->where('blog_id', $baiviet->id)->where('like',1);
    }
}
