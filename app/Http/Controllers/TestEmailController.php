<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class TestEmailController extends Controller
{
    public function email(){
        $name = 'Nguyen Nhat Truong';
        Mail::send('email.test', compact('name'), function($email) use ($name){
            $email->subject('Xác minh email Webstie News của bạn');
            $email->to('truongnguyennhat098@gmail.com', $name);
        });
    }
}
