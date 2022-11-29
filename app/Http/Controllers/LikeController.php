<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\likeDislike;
use Response;
use App\Models\Blogger;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{   
    public function like(){
        $like = likeDislike::with('user','blog')->orderBy('id', 'desc')->get();
        // dd($like);
        return view('admin.admin.like')->with(compact('like'));
    }

}
