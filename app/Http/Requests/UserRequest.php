<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'username' => 'required|min:3|max:20',
//            'full_name' => 'required|min:5|max:30',
            'password' => 'required',
            'email' => ['regex: /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
        ];
    }
    public function messages()
    {
        return [
            'username.required' => 'Không được để trống tên đăng nhập',
//            'username.unique' => 'Tài khoản đã tồn tại',
            'username.min' => 'Nhập ký tự nhiều hơn 3',
            'username.max' => 'Nhập ký tự ít hơn 20',
            'password.required' => 'Không được để trống mật khẩu',
            'password.regex' => 'Không mật khẩu ít nhất 8 ký tự có chữ in hoa, in thường, số',
            'full_name.required' => 'Không được để trống họ tên',
            'email.required' => 'Không được để trống email',
            'email.exist' => 'Email đã tồn tại',
            'email.regex' => 'Email sai định dạng',
            ];
    }
}
