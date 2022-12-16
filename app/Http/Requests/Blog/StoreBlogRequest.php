<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
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
                'tenblog'=>'required|unique:bloggers|max:255',
                'tomtat'=>'required|max:255',
                'blog_noibat'=>'required',
                'image'=>'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|
                 dimensions:min_width=100, min_height=100, max_width=2000,max_height=2000',
                'content'=>'required',
        ];
    }

    public function messages()
    {
        return [
                'tenblog.unique'=>'Xin vui lòng điền tên bài viết mới ',
                'tenblog.required'=>'Xin vui lòng điền tên bài viết',
                'tomtat.required'=>'Xin vui lòng điền tóm tắt',
                'blog_noibat.required'=>'Xin vui lòng chọn blog nổi bật',
                'image.required'=>'Xin vui lòng chọn hình ảnh',
                'content.required'=>'Xin vui lòng điền nội dung',
        ];
    }
}
