<?php

namespace App\Http\Controllers;

use App\Models\ManagerUser;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Http\Requests\ManagerUser\StoreUserRequest;
use App\Http\Requests\ManagerUser\UpdateUserRequest;
use Spatie\Permission\Models\Role;

class ManagerUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function __construct()
    // {
    //     $this->middleware('permission:add articles|add category',['only' => ['create','store']]);
    //     $this->middleware('permission:edit articles|edit category',['only'=>['edit','update']]);
    //     $this->middleware('permission:delete articles|delete category',['only'=>['destroy','update']]);
    // }

    public function index()
    {
        $user = User::orderBy('id','desc')->where('staff_id','0')->get();
        return view('admin.manager_user.index', compact('user'));
    }

    public function staff_user(){
        $user = User::orderBy('id','desc')->where('staff_id','1')->get();
        return view('admin.manager_user.index_staff', compact('user'));
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $province_all = Province::all();
        $district_all = District::all();
        $ward_all = Ward::all();

        $userAddress = [];
        $userAddress = [
            "province" => $province_all,
            "district" => $district_all,
            "ward" => $ward_all,
        ];
        $vaitro = Role::whereIn('name',['blogger','viewer'])->get();
        foreach($vaitro as $vai){
            $data[] = $vai->id;
        }
        $role = Role::orderBy('id','asc')->whereNotIn('id', $data)->get();
        return view('admin.manager_user.create')->with(compact('userAddress','role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = new User();
        $user->fill($request->all());
        $user->staff_id = 1;
        $user->password = Hash::make($request['password']);
        if(request()->has('avatar')){
            $get_image = $request->avatar;  
            $path = 'public/uploads/user/';
            $get_name_image = $get_image->getClientOriginalName(); 
            $name_image = current(explode('.', $get_name_image )); //Lấy tên hình ảnh gắn định dạng 
            $new_image = $name_image.rand (0,99).'.'.$get_image->getClientOriginalExtension(); //Trả về đuôi mở rộng của file
            $get_image->move($path, $new_image);
        }else{
            $new_image  = 'default-avatar.jpg';
        }
        $user->syncRoles($request['role']);
        $user->save();
        return redirect()->back()->with('success','Thêm user thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManagerUser  $managerUser
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $user = User::findOrFail($id);
        $userprovince = $user->province;
        $userdistrict = $user->district;
        $userward = $user->ward;
        // dd($userprovince);
        return view('admin.manager_user.view')->with(compact('user', 'userprovince', 'userdistrict', 'userward'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManagerUser  $managerUser
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $user_province = User::with('province')->where('province_id',$user->province_id)->get();
        $user_district = User::with('district')->where('district_id',$user->district_id)->get();
        $user_ward = User::with('ward')->where('ward_id',$user->ward_id)->get();
        
        $userAddress = [];
        $userAddress = [
            "province" => $user_province,
            "district" => $user_district,
            "ward" => $user_ward,
        ];
        return view('admin.manager_user.edit')->with(compact('user', 'userAddress'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManagerUser  $managerUser
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {

        $user = User::find($id);
        $data = $request->all();

        $get_image = $request->avatar;
        // dd($get_image);
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
        // dd($user->update());
        // $user->update($data);
        // dd($user);
        $user->update($data);

        return redirect()->back()->with('success', 'Thêm user thành công');
    }
    
    public function phanvaitro($id){
        $user = User::findOrFail($id);
        // dd($user);
        // cấp quyền
        $vaitro = Role::where('name','=','blogger')->get();
        foreach($vaitro as $vai){
            $data[] = $vai->id;
        }
        $role = Role::orderBy('id','asc')->whereNotIn('id', $data)->get();
        $all_column_roles = $user->roles->first();
        return view('admin.manager_user.phanvaitro', compact('user','role','all_column_roles'));
    }

    public function insert_roles(Request $request, $id){
        $data = $request->all();
        $user = User::find($id);
        $user->syncRoles($data['role']);
        // dd($data['role']);
        return redirect('userpermission')->with('success','Thêm vai trò user thành công');   
    }

    public function accept_role(Request $request){
        $user = User::find($request->user_id);
        $user->accept_blogger = $request->accept_blogger;
        if($user->accept_blogger== 1){
            $user->syncRoles("blogger");    
        }elseif($user->accept_blogger== 0)
        {
            $user->syncRoles("viewer");
        }
        $user->save();
        return response()->json(['success'=>'Status change successfully.']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManagerUser  $managerUser
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();
        return response()->json($user);
    }
}
