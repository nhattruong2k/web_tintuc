<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blogger;
class recentlyViewed extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $dates = [
        'created_at','updated_at',
    ];
    
    protected $fillable = [
        'blog_id', 'session_id','user_id'
    ];
    public function blog(){
        return $this->belongsTo(Blogger::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
