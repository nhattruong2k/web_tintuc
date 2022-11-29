<?php

namespace App\Http\Requests\DanhMuc;

use Illuminate\Foundation\Http\FormRequest;

class StoreDanhMucRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'tendanhmuc' => 'required|unique:danh_mucs|max:255',
                'slug_danhmuc'=>'required|unique:danh_mucs|max:255',
                'motadanhmuc'=>'required|unique:danh_mucs|max:255',
                'motadanhmuc' =>'required|max:255',
        ];
    }

    public function messages()
    {
        return [
                'tendanhmuc.unique' => 'Tên danh mục đã có vui lòng điền tên khác',
                'slug_danhmuc.unique' => 'Slug danh mục đã có vui lòng điền slug khác',
                'tendanhmuc.required' => 'Tên danh mục vui lòng phải có',
                'slug_danhmuc.required' => 'Tên slug_danhmuc vui lòng phải có',
                'motadanhmuc.required' =>'Mô tả danh mục phải có',
        ];
    }
}
