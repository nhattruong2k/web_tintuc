<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\TestNotification;
use App\Models\User;
use App\Notifications\RepliedToThread;
use Pusher\Pusher;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB as FacadesDB;
use ParagonIE\Sodium\Compat;

use function Sodium\compare;

class SendNotification extends Controller
{
    public function index()
    {
        $notifications = FacadesDB::table('notifications')->select('id','data')->get();
        $data = [];
        foreach($notifications as $key=> $notification) {
            $newItem = json_decode($notification->data);
            $newItem->id = $notification->id;
            $data[] = $newItem; 
        };
        return view('admin.notification.index', ['notifications'=>$data]);
    }

    public function create()
    {
        return view('admin.notification.notifi');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'title' => 'required',
            'content' => 'required'
        ],
        [
            'email.required' => 'Email không được để trống',
            'title.required' => 'Tiêu đề không được để trống',
            'content.required' => 'Nội dung không để trống',
        ]
    );
        $data['email'] = $request->input('email');
        $data['title'] = $request->input('title');
        $data['content'] = $request->input('content');
        
       $user = User::first();
       Notification::send($user,new TestNotification($data));
        // dd($user->notifications);
        return redirect()->back()->with('success', 'Thêm thông báo thành công');
    }

    public function destroy($id)
    {
        FacadesDB::table('notifications')->where('id','=',$id)->delete();
        return redirect()->back()->with('success', 'Xóa thông báo thành công');
    }

}

