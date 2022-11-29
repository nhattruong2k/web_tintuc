<?php

namespace App\Http\Requests\ManagerUser;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'ninkname'=>'required|max:255',
            'email' => 'required|max:255|email|unique:users',
            'phone' => 'required|digits:10|regex:/(0)[0-9]{9}/|unique:users|numeric',
            'gender' => 'required',
            'avatar'=>'sometimes|image|mimes:jpg,jpeg,bmp,svg,png',
            'password'=>'required|min:8',
            'birth_date' => 'required',
            'birth_date'=>'date_format:m/d/Y|before:today',
            'province_id'=>'required',
            'district_id' => 'required',
            'ward_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Xin vui lòng điền tên thông tin ',
            'password.required'=>'Xin vui lòng điền password',
            'password.min'=>'Phải có ít nhất 8 ký tự',
            'ninkname.required' => 'Xin vui lòng điền nick name thông tin',
            'email.required' => 'Xin vui lòng điền email',
            'email.unique'=>'email đã được sử dụng',
            'phone.required' => 'xin vui lòng điền số điện thoại ',
            'phone.digits' => 'Điện thoại phải có 10 chữ số',
            'phone.regex' => 'Định dạng điện thoại không hợp lệ',
            'gender.required' => 'gender xin vui lòng điền thông tin ',
            'birth_date.required' => 'xin vui lòng điền ngày sinh ',
            'birth_date.before' => 'Ngày sinh phải là một ngày trước ngày hôm nay',
            'birth_date.date_format' => 'Ngày sinh không khớp với định dạng tháng/ngày/năm',
            'province_id' => 'Xin vui lòng điền thành phố ', 
            'district_id' => 'Xin vui lòng điền quận/huyện ',
            'ward_id' => 'Xin vui lòng điền phường/xã ',
        ];
    }
}
