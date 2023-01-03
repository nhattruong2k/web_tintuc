<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReturnTypeWillChange;

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
    
    public function scopeEdit_cate($query, $danhmuctintuc){
        return $query->where('parent_id','<=>','id')->Where('id','<>',$danhmuctintuc->id);
    }

    public function scopeParent_cate($query){
        return $query->with('children','nhieublog')->orderBy('id','desc')->where('parent_id','0')->where('kichhoat', 1);
    }

    public function scopeChild_cate($query){
        return $query->with('children','nhieublog')->orderBy('id','desc')->where('kichhoat', 1);
    }
    
    public function scopeCaterogy($query, $slug){
        return $query->where('slug_danhmuc', $slug)->with('children');
    }

    public function scopeCategory2($query, $danhmuc_id){
        return $query->where('id', $danhmuc_id->parent_id)->with('children');
    }

    public function scopeSame_Cate($query, $nhiublog){
        return $query->with('nhieublog')->where('id',$nhiublog)->take(3);
    }
    
}
