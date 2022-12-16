<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc;
use Illuminate\Http\Request;
use  App\Http\Requests\DanhMuc\StoreDanhMucRequest;
use  App\Http\Requests\DanhMuc\UpdateDanhMucRequest;
use App\Notifications\TestNotification;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Imports\ExcelImports;
use App\Exports\ExcelExports;
use Excel;
use App\Imports\Imports;

class DanhMucController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:add articles|add category',['only' => ['create','store','danhmuc_con','store_parent']]);
        $this->middleware('permission:edit articles|edit category',['only'=>['edit','update']]);
        $this->middleware('permission:delete articles|delete category',['only'=>'destroy']);
    }

    public function index(Request $request)
    {
        $danhmuctintuc = DanhMuc::orderBy('id', 'desc')->get();
        return view('admin.danhmuc.index')->with(compact('danhmuctintuc'));
    }

    public function kichhoat(Request $request){ 
        // dd($request->all());
        $danhmuc_kichoat =  DanhMuc::find($request->danhmuc_id);
        $danhmuc_kichoat->kichhoat = $request->kichhoat;
        $danhmuc_kichoat->save();
        return response()->json(['success'=>'Status change successfully.']);

    } 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = DanhMuc::where('parent_id','0')->get();
        return view('admin.danhmuc.create')->with(compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDanhMucRequest $request)
    {
        $danhmuctintuc = new DanhMuc();
        $danhmuctintuc->fill($request->all());
        // if($danhmuctintuc->save())
        // {
        //     $user = User::all();
        //     Notification::send($user,new TestNotification($danhmuctintuc));
        // }
        $danhmuctintuc->save();
        return redirect('danhmuc')->with('success', 'Thêm danh mục thành công');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DanhMuc  $danhMuc
     * @return \Illuminate\Http\Response
     */
    public function show(DanhMuc $danhMuc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DanhMuc  $danhMuc
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $danhmuctintuc = DanhMuc::find($id);
        $danhmuc= DanhMuc::where('parent_id','<=>','id')->Where('id','<>',$danhmuctintuc->id)->get();
        return view('admin.danhmuc.edit')->with(compact('danhmuctintuc','danhmuc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DanhMuc  $danhMuc
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDanhMucRequest $request, $id)
    {
        $danhmuctintuc = DanhMuc::find($id);
        // dd($danhmuctintuc);
        $danhmuctintuc->fill($request->all());
        $danhmuctintuc->save();
        return redirect('danhmuc')->with('success', 'Thêm danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DanhMuc  $danhMuc
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DanhMuc::find($id)->delete();
        return redirect()->back()->with('success', 'Xóa danh mục thành công');
    }

    public function export_csv(){
        return Excel::download(new ExcelExports, 'danhmuc.xlsx');
    }

    public function import_csv(Request $request){
        $path = $request->file('file')->getRealPath();
        Excel::import(new Imports, $path);
        return back();
    }
}
