<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\ChangePass\ChangePassword_UserRequest;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToArray;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }
    public function profileAdmin(){
        $user = User::findOrFail(auth()->user()->id);
        $user_province = User::with('province')->where('province_id',$user->province_id)->get();
        $user_district = User::with('district')->where('district_id',$user->district_id)->get();
        $user_ward = User::with('ward')->where('ward_id',$user->ward_id)->get();
        
        $userAddress = [];
        $userAddress = [
            "province" => $user_province,
            "district" => $user_district,
            "ward" => $user_ward,
        ];
        return view('admin.admin.profileAdmin')->with(compact('user', 'userAddress'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $data = $request->all();

        $get_image = $request->image;
        if($get_image)
        {
            $path = 'public/uploads/user/'.$user->avatar;
            if(file_exists($path)){
                unlink($path);
            }
        $path = 'public/uploads/user/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image )); //Lấy tên hình ảnh gắn định dạng 
        $new_image = $name_image.rand (0,99).'.'.$get_image->getClientOriginalExtension(); //Trả về đuôi mở rộng của file
        $get_image->move($path, $new_image);
        $user->avatar = $new_image;
        }
        $user->update($data);
        return redirect()->back()->with('success', 'Thêm user thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }

    public function showChangePassword(){
        $pass = User::find( auth()->user()->id );
        return view('admin.admin.changePasswordAdmin')->with(compact('pass'));
    }

    public function changePassword(Request $request){
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Mật khẩu hiện tại của bạn không khớp với mật khẩu bạn đã cung cấp. Vui lòng thử lại.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","Mật khẩu mới không được giống với mật khẩu hiện tại của bạn. Vui lòng chọn một mật khẩu khác.");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ],
        [
            'current-password' => 'Bắt buộc phải có',
            'new-password.min' => 'Ít nhất có 6 ký tự',
            'new-password.confirmed' => 'Xác nhận mật khẩu mới không khớp.',
        ]
    );
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success","Mật khẩu đã thay đổi thành công !");
    }


// RESET Password
    public function showPassword($id){
        $user = User::find($id);
        // dd($user->password);
        return view('admin.manager_user.resetPassword')->with(compact('user'));
    }

    public function resetPassword(Request $request, $id){
        $validatedData = $request->validate([
            'random-password' => 'required',
        ],
        [
            'random-password.required' => 'Xin vui random mật khẩu',
        ]);
        $user = User::find($id);
        $user->password = bcrypt($request->get('random-password'));
        $data = $request->all();
        $user->update($data);
        return redirect()->back()->with("success","Mật khẩu đã thay đổi thành công !");
    }
}
