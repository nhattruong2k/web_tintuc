<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SocialController extends Controller
{
    public function redirectGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function processGoogleLogin(){
        $googleUser = Socialite::driver('google')->user();
        // dd($googleUser);
        if(!$googleUser){
            return redirect('login');
        }
        
        $systemUser = User::firstOrCreate(  
            ['google_id' => $googleUser->id],
            [
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'password' => bcrypt(Str::random(10)),
                'remember_token' => Str::random(10),
            ]
        );
        Auth::loginUsingId($systemUser->id);
        return redirect('/home-new');
    }
}
