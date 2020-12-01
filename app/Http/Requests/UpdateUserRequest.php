<?php

namespace App\Http\Requests;

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
            //
            'username' => 'required|min:3|max:20',
            'full_name' => 'required|min:5|max:30',
            'email' => ['required','regex: /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
            'role' => 'in:1,2',
            'age' => 'required|numeric|integer|min:1|max:150',
            'gender' => 'in:1,2,3',
            'address' => 'required|max:500',
            'job' => 'max:80',
            'company' => 'max:100',
        ];
    }
    public function messages()
    {
        return [
            'username.required' => 'Không được để trống tên đăng nhập',
            'username.unique' => 'Tài khoản đã tồn tại',
            'username.min' => 'Nhập ký tự nhiều hơn 3',
            'username.max' => 'Nhập ký tự ít hơn 20',
            'full_name.required' => 'Không được để trống họ tên',
            'full_name.min' => 'Nhập họ tên nhiều hơn 5 ký tự',
            'full_name.max' => 'Nhập họ tên ít hơn 30 ký tự',
            'email.required' => 'Không được để trống email',
            'email.unique' => 'Email đã tồn tại',
            'email.regex' => 'Email sai định dạng',
            'role.in' => 'Không chọn đúng quyền',
            'age.required' => 'Không được để trống trường tuổi',
            'age.numeric' => 'Tuổi nhập số',
            'age.integer' => 'Tuổi nhập số dương',
            'age.min' => 'Tuổi nhập số dương',
            'age.max' => 'Tuổi nhỏ hơn 150',
            'address.required' => 'Không được để trống trường địa chỉ',
            'gender.in' => 'Không chọn đúng giới tính',
            'address.max' => 'Nhập địa chỉ ít hơn 500 ký tự',
            'job.max' => 'Nhập trường nghề nghiệp ít hơn 80 ký tự',
            'company.max' => 'Nhập trường công ty ít hơn 80 ký tự',
        ];
    }
}
