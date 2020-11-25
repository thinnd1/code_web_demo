<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            //
            'username' => 'required|unique:customers|min:5|max:20',
            'full_name' => 'required|min:5|max:60',
            'phone' => 'required|numeric',
            'email' => 'required|email|unique:users',
            'age' => 'required|numeric|integer|min:0',
            'address' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'username.required' => 'Không được để trống tên đăng nhập',
            'username.unique' => 'Tài khoản đã tồn tại',
            'username.min' => 'Nhập tên đăng nhập nhiều hơn 5 ký tự',
            'username.max' => 'Nhập tên đăng nhập ít hơn 20 ký tự ',
            'full_name.required' => 'Không được để trống họ tên',
            'full_name.min' => 'Nhập họ tên nhiều hơn 5 ký tự',
            'full_name.max' => 'Nhập họ tên ít hơn 60 ký tự',
            'phone.required' => 'Không được để trống số điện thoại',
            'phone.numeric' => 'Số điện thoại là số',
            'email.required' => 'Không được để trống email',
            'email.unique' => 'Email đã tồn tại',
            'email.email' => 'Email sai định dạng',
            'age.required' => 'Không được để trống tuổi',
            'age.numeric' => 'Tuổi nhập số',
            'age.integer' => 'Tuổi nhập số dương',
            'age.min' => 'Tuổi nhập số dương',
            'address.required' => 'Không được để trống địa chỉ',
        ];
    }
}
