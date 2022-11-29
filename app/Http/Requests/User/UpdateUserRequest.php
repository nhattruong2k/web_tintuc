<?php

namespace App\Http\Requests\User;

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
            'birth_date' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'xin vui lòng điền tên ',
            'email.required' => 'xin vui lòng điền email',
            'birth_date.required' => 'Xin điền ngày sinh thông tin',
            'province_id' => 'province xin vui lòng điền thông tin ', 
            'district_id' => 'district_id xin vui lòng điền thông tin ',
            'ward_id' => 'ward_id xin vui lòng điền thông tin ',
        ];
    }
}
