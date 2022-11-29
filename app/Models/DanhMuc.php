<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    use HasFactory;

    protected $fillable = [
        'tendanhmuc', 'motadanhmuc','kichhoat', 'slug_danhmuc','parent_id',
    ];
    
    public function parentCategory(){   //1-n
        return $this->belongsTo('App\Models\DanhMuc','parent_id');
    }
  


    public function children(){ //những thằng con category
        return $this->hasMany('App\Models\DanhMuc', 'parent_id', 'id')->with('parentCategory','nhieublog');
    }

    public function nhieublog(){
        return $this->belongsToMany(Blogger::class, 'thuocdanhmucs', 'danhmuc_id', 'blog_id');
    }
}
