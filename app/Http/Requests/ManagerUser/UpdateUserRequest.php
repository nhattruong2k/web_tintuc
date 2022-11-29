<?php

namespace App\Http\Requests\ManagerUser;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'gender' => 'required',
            'birth_date' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'xin vui lòng điền tên thông tin ',
            'email.required' => 'xin vui lòng điền email thông tin',
            'email.unique'=>'email đã được sử dụng',
            'gender.required' => 'Xin vui lòng điền giới tính ',
            'birth_date.required' => 'Xin vui lòng điền ngày sinh ',
        ];
    }
}
