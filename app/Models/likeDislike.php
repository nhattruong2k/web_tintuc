<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
