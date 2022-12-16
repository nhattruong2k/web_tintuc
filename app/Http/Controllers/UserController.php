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
use Spatie\Permission\Models\Permission;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        // $user = User::find(1);
        // $user->assignRole('admin');

        // auth()->user()->assignRole('admin');
        // Role::create(['name' => 'blogger']);
        // Permission::create(['name' => 'add articles']);
        // Permission::create(['name' => 'add category']);
        // Permission::create(['name' => 'edit articles']);
        // Permission::create(['name' => 'edit category']);
        // Permission::create(['name' => 'delete articles']);
        // Permission::create(['name' => 'delete category']);

        // $role = Role::find(1);
        // $permission = Permission::find(['1','2','3','4','5','6',]);
        // $role->givePermissionTo($permission);
        return view('layouts.app');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $user_id = auth()->user()->id;
        // $user = User::find($user_id);
        // // dd(md5($user->password));
        // // die();
        // $userprovince = $user->province;
        // $userdistrict = $user->district;
        // $userward = $user->ward;

        // return view('admin.user.edit')->with(compact('user', 'userprovince', 'userdistrict', 'userward'));
    }

    public function profile(){
        $user = User::findOrFail(auth()->user()->id);
        $province_all=Province::all();
        $district_all = District::all();
        $ward_all = Ward::all();
        
        return view('admin.user.edit')->with(compact('user','province_all','district_all','ward_all',));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();
        return redirect()->back()->with('success', 'Xóa user thành công');

    }
    // public function showChangePassword(){
    //     $pass = User::find( auth()->user()->id );
    //     return view('auth.changePassword')->with(compact('pass'));
    // }

    // public function changePassword(Request $request){
    //     if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
    //         // The passwords matches
    //         return redirect()->back()->with("error","Mật khẩu hiện tại của bạn không khớp với mật khẩu bạn đã cung cấp. Vui lòng thử lại.");
    //     }

    //     if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
    //         //Current password and new password are same
    //         return redirect()->back()->with("error","Mật khẩu mới không được giống với mật khẩu hiện tại của bạn. Vui lòng chọn một mật khẩu khác.");
    //     }
    //     $validatedData = $request->validate([
    //         'current-password' => 'required',
    //         'new-password' => 'required|string|min:6|confirmed',
    //     ],
    //     [
    //         'current-password' => 'Bắt buộc phải có',
    //         'new-password.min' => 'Ít nhất có 6 ký tự',
    //         'new-password.confirmed' => 'Xác nhận mật khẩu mới không khớp.',
    //     ]
    // );

    //     //Change Password
    //     $user = Auth::user();
    //     $user->password = bcrypt($request->get('new-password'));
    //     $user->save();
    //     return redirect()->back()->with("success","Mật khẩu đã thay đổi thành công !");
    // }
}
