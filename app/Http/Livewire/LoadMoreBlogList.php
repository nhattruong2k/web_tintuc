<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Blogger;

class LoadMoreBlogList extends Component
{
    public $perPage = 3;
    protected $listeners = [
        'load-more' => 'loadMore'
    ];
    public function loadMore()
    {
        $this->perPage = $this->perPage + 3;
    }
    public function render()
    {
        $blogger = Blogger::latest()->where('kichhoat', 1)->paginate($this->perPage);
        $this->emit('blogStore');
        function slugify($str) { 
            $str = trim(mb_strtolower($str)); 
            $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str); 
            $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str); 
            $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str); 
            $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str); 
            $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str); 
            $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str); 
            $str = preg_replace('/(đ)/', 'd', $str); 
            $str = preg_replace('/[^a-z0-9-\s]/', '', $str); 
            $str = preg_replace('/([\s]+)/', '-', $str); 
        return $str; 
        }

        foreach($blogger as $blog){
             $blog->tacgia_slug = slugify($blog->user->name);
        }
        return view('livewire.load-more-blog-list')->with(compact('blogger'));
    }
}
