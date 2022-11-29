<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Auth;

class NotificationController extends Controller
{
    public function get(){
        $notification = Auth::user()->unreadNotifications;
        return $notification;
    }

    public function read(Request $request){
        return Auth::user()->unreadNotifications()->find($request->id)->markAsRead();
    }
}
