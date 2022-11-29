<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CommentLoginController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8',
        ],[
            "email.required" => "Xin vui lòng điền Email",
            "email.email" => "Email không hợp lệ",
            "email.exists" => "Email không tồn tại",
            "password.required" => "Xin vui lòng điền mật khẩu",
            "password.min" => "mật khẩu phải có ít nhất 8 kí tự",
            
        ]);
            if($validator->passes()){
                $data = $request->only('email','password');
                $check_login = Auth::attempt($data);    //attempt: nó sẽ trả về true or false->xác thực thành công
                if($check_login){
                    if(!Auth::user()){
                        Auth::logout();
                        return response()->json(['error'=>'Tài khoản của bạn chưa đăng ký']);
                    }
                    return response()->json(['data'=> Auth::user()]);
                }
            }
            return response()->json(['error' => $validator->errors()->all()]);
        }
    
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|alpha|string|max:255',
            'nickname'=>'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone'=>'required|numeric|unique:users|regex:/(0)[0-9]{9}/|digits:10',
       ],[
                'name.required'=>'Xin vui lòng điền tên ',
                'name.alpha'=> 'tên phải là chữ',
                'password.required'=>'Xin vui lòng điền password',
                'password.min'=>'Phải có ít nhất 8 ký tự',
                'nickname.required' => 'Xin vui lòng điền nickname',
                'email.required' => 'xin vui lòng điền email',
                'email.unique'=>'email đã được sử dụng',
                'phone.required' => 'xin vui lòng điền phone ',
                'phone.digits' => 'Điện thoại phải có 10 chữ số',
                'phone.regex' => 'Định dạng số điện thoại không hợp lệ',
                'phone.unique' => 'Xin vui lòng điền số điện thoại khác ',
       ]);
            if($validator->passes()){
                $user = User::where('email', $request['email'])->first();
                if($user) {
                    return response()->json(['error' => 'Email đã sử dụng']);
                }else{
                    $user = new User;
                    $user->name = $request['name'];
                    $user->ninkname = $request['nickname'];
                    $user->email = $request['email'];
                    $user->password = Hash::make($request['password']);
                    $user->phone = $request['phone'];
                }
                // dd($user);
                $user->save();
                return response()->json(['success' => 'Bạn đã đăng ký thành công']);
            }
                return response()->json(['error'=>$validator->errors()->all()]);
        }
    }