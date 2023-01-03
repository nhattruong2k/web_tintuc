<?php

namespace App\Http\Controllers;

use App\Models\Blogger;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class CommentController extends Controller
{
    public function binhluan(Request $request, $blog_id){
        $customer_id = Auth::user()->id;
        // dd( $avatar_customer);
        $validator = Validator::make($request->all(), [
            'comment_body' => 'required',
        ],[
            "comment_body.required" => "Nội dung không được để trống",
        ]);

        if($validator->passes()){
            $data = [
                'blog_id' => $blog_id,
                'user_id'=>$customer_id,
                'comment_body' => $request->comment_body,
                'reply_id' =>$request->reply_id ? $request->reply_id : 0
            ];
            // dd($data);
            if($comment = Comment::create($data)){
                $comment = Comment::with('user','replies')->where(['blog_id' => $blog_id, 'reply_id'=> 0])->orderBy('id','desc')->where('kichhoat', 0)->get();
                return view('pages.list-comment')->with(compact('comment'));
                }
            }
            return response()->json(['error' => $validator->errors()->first()]);
    }

    public function list_comment(){
        $list_comment = Comment::with(['user','baiviet'])->orderBy('id', 'DESC')->get();
        // dd($list_comment);
        return view('admin.list_comment')->with(compact('list_comment'));
    }
    public function update_comment(Request $request){
        $comment_kichoat =  Comment::find($request->comment_id);

       $comment_kichoat->kichhoat = $request->kichhoat;
    //    dd( $comment_kichoat);
       $comment_kichoat->save();
        return response()->json(['success'=>'Status change successfully.']);
    }
}
