<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Blogger;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $list_blog = Blogger::orderby('id','desc')->get();
        // $list_user = User::orderby('id','desc')->get();
        // $count_blog =  $list_blog->count();
        // $count_user =  $list_user->count();
        // return view('admin.dashboard.index')->with(compact('count_blog','count_user'));
        return view('index');
    }
}
