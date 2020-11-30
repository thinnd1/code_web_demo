<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
            'username' => 'required|min:3|max:20|unique:users,username',
            'full_name' => 'required|min:5|max:30',
            'password' => 'required|min:6|max:15',
            'email' => ['required','unique:users,email','regex: /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
        ];
    }
    public function messages()
    {
        return [
            'username.required' => 'Không được để trống tên đăng nhập',
            'username.unique' => 'Tài khoản đã tồn tại',
            'username.min' => 'Nhập ký tự nhiều hơn 3',
            'username.max' => 'Nhập ký tự ít hơn 20',
            'password.required' => 'Không được để trống mật khẩu',
            'password.min' => 'Nhập mật khẩu nhiều hơn 6 ký tự',
            'password.max' => 'Nhập mật khẩu ít hơn 15 ký tự',
            'full_name.required' => 'Không được để trống họ tên',
            'full_name.min' => 'Nhập họ tên nhiều hơn 5 ký tự',
            'full_name.max' => 'Nhập họ tên ít hơn 30 ký tự',
            'email.required' => 'Không được để trống email',
            'email.unique' => 'Email đã tồn tại',
            'email.regex' => 'Email sai định dạng',
        ];
    }
}
