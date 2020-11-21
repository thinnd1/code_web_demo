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
            'username' => 'required|unique:users|min:5|max:20',
            'full_name' => 'required',
            'password' => 'required',
            'email' => 'required|email|unique:users'
        ];
    }
    public function messages()
    {
        return [
            'username.required' => 'Không được để trống',
            'username.unique' => 'Tài khoản đã tồn tại',
            'username.min' => 'Nhập ký tự nhiều hơn 5',
            'username.max' => 'Nhập ký tự ít hơn 20',
            'password.required' => 'Không được để trống',
            'full_name.required' => 'Không được để trống',
            'email.required' => 'Không được để trống',
            'email.exist' => 'Nhập đúng định dạng mail',
            ];
    }
}
