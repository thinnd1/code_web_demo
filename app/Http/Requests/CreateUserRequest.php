<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'username' => 'required|unique:customer|min:5|max:20',
            'full_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users'
        ];
    }
    public function messages()
    {
        return [
            'username.required' => 'Không được để trống tên đăng nhập',
            'username.unique' => 'Tài khoản đã tồn tại',
            'username.min' => 'Nhập ký tự nhiều hơn 5',
            'username.max' => 'Nhập ký tự ít hơn 20',
            'full_name.required' => 'Không được để trống họ tên',
            'phone.required' => 'Không được để trống số điện thoại',
            'email.required' => 'Không được để trống email',
            'email.exist' => 'Nhập đúng định dạng mail',
            'email.unique' => 'Email đã tồn tại',
        ];
    }
}
