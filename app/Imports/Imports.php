<?php

namespace App\Imports;

use App\Models\DanhMuc;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithValidation;

class Imports implements ToModel, WithValidation, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function headingRow() : int
    {
        return 1;
    }

    public function model(array $row)
    {   
        return new DanhMuc([
            'tendanhmuc' => $row['tendanhmuc'] ?? $row['title_category'],
            'motadanhmuc' => $row['motadanhmuc'] ?? $row['desc_category'],
            'slug_danhmuc' => $row['slug_danhmuc'] ?? $row['slug_category'],
            'parent_id' => $row['parent_id'] ?? $row['parent_id'],
            'kichhoat' => $row['kichhoat'] ?? $row['activiti'],
        ]);
    }

    public function rules(): array
    {
        return [
            '*.tendanhmuc' =>"unique:danh_mucs",
            '*.motadanhmuc' =>"unique:danh_mucs",
            '*.slug_danhmuc' =>"unique:danh_mucs",
            '*.parent_id' =>"unique:danh_mucs",
            '*.kichhoat' =>"unique:danh_mucs",
        ];
    }
}
