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
            'username' => 'required|exists:users|min:10|max:50',
            'full_name' => 'required',
            'email' => 'required|email|unique:users'
        ];
    }
    public function messages()
    {
        return [
            'username.required' => 'Không được để trống',
            'username.exists' => 'Tài khoản đã tồn tại',
            'username.min' => 'Nhập ký tự nhiều hơn 10',
            'username.max' => 'Nhập ký tự ít hơn 50',
            'full_name.required' => 'Không được để trống',
            'email.required' => 'Không được để trống',
            ];
    }
}
