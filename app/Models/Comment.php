<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'blog_id', 'user_id', 'comment_body', 'reply_id','kichhoat',
    ];

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function baiviet(){
        return $this->hasOne(Blogger::class, 'id', 'blog_id');
    }
    public function replies(){
        return $this->hasMany(Comment::class, 'reply_id','id');
    }
}
