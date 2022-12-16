<?php

namespace App\Exports;

use App\Models\DanhMuc;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ExcelExports implements FromView
{
    public function view(): View {
        return view('admin.danhmuc.exportExcel', [
            'danhmucs' => DanhMuc::select('tendanhmuc','motadanhmuc','slug_danhmuc','parent_id','kichhoat')->get()
        ]);
    }
}
