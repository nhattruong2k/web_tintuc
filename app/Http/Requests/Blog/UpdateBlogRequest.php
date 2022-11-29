<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
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
            'tenblog'=>'required|max:255',
            'tomtat'=>'required|max:255',
            'blognoibat'=>'required',
            'content'=>'required',
            'danhmuc' => 'required',
            'slug_blog'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'tenblog.unique'=>'Xin vui lòng điền tên bài viết mới ',
            'tenblog.required'=>'Xin vui lòng điền tên bài viết',
            'tomtat.required'=>'Xin vui lòng điền tóm tắt',
            'blognoibat.required'=>'Xin vui lòng chọn blog nổi bật',
            'image.required'=>'Xin vui lòng chọn hình ảnh',
            'content.required'=>'Xin vui lòng điền nội dung',
        ];
    }
}
