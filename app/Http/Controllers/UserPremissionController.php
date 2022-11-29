<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use redirect;
class UserPremissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function index()
    {
        $vaitro = Role::whereIn('name',['blogger','viewer'])->get();
        foreach($vaitro as $vai){
            $data[] = $vai->id;
        }
        $role = Role::orderBy('id','asc')->whereNotIn('id', $data)->get();  
        
        return view('admin.user.index_permission')->with(compact('role'));
    }

    public function quyen($id){
        $role = Role::find($id);

        $permission = Permission::orderBy('id', 'ASC')->get();
         $get_permission_via_role = $role->getAllPermissions(); 
        // dd($get_permission_via_role);
        return view('admin.user.quyen', compact('role', 'permission', 'get_permission_via_role'));
    }
    
    public function insert_permission(Request $request, $id){
        $data = $request->all();
        // Cấp quyền 
        $role = Role::find($id); // tìm được quyền dựa vào role_id       
        if(request()->has('permission')){
            $role->syncPermissions($data['permission']);
        }
        return redirect('userpermission')->with('success','Thêm quyền cho user thành công');
    }

    public function axtra_permission(Request $request){
        $data = $request->all();
        $permission = new Permission();
        $permission->name = $data['permission'];
        $permission->save();

        return redirect()->back()->with('success','Thêm quyền thành công');

    }
}
