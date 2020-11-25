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
            'username' => 'required|min:5|max:20',
            'full_name' => 'required|min:5|max:60',
            'phone' => ['required','regex: /^\+?\d{10,11}$/i'],
            'email' => ['required','regex: /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
            'age' => 'required|numeric|integer|min:0',
            'gender' => 'required|in:1,2,3',
            'address' => 'max:500',
            'job' => 'max:80',
            'company' => 'max:80',
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
            'phone.required' => 'Không được để trống số trường điện thoại',
            'phone.regex' => 'Số điện thoại nhập không đùng',
            'email.required' => 'Không được để trống trường email',
            'email.unique' => 'Email đã tồn tại',
            'email.regex' => 'Email sai định dạng',
            'age.required' => 'Không được để trống trường tuổi',
            'age.numeric' => 'Tuổi nhập số',
            'age.integer' => 'Tuổi nhập số dương',
            'age.min' => 'Tuổi nhập số dương',
            'address.required' => 'Không được để trống trường địa chỉ',
            'gender.in' => 'Không chọn đúng giới tính',
            'address.max' => 'Nhập địa chỉ ít hơn 500 ký tự',
            'job.max' => 'Nhập trường nghề nghiệp ít hơn 80 ký tự',
            'company.max' => 'Nhập trường công ty ít hơn 80 ký tự',
        ];
    }
}
