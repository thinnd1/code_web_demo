<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'name_shop' => 'required|min:5|max:50',
            'address' => 'required|max:200',
            'phone' => 'required|numeric|min:9',
            'email' => 'required|email',
            'quantity_product' => 'required|numeric',
        ];
    }
    public function messages()
    {
        return [
            'name_shop.required' => 'Không được để trống tên công ty',
            'name_shop.min' => 'Nhập ký tự nhiều hơn 5',
            'name_shop.max' => 'Nhập ký tự ít hơn 50',
            'address.required' => 'Không được để trống địa chỉ',
            'address.max' => 'Nhập ký tự ít hơn 200',
            'quantity_product.required' => 'Không được để trống số hàng đã mua',
            'quantity_product.numeric' => 'Nhập số hàng đã mua',
            'phone.required' => 'Không được để trống số điện thoại',
            'phone.numeric' => 'Nhập số điện thoại',
            'phone.min' => 'Nhập số điện thoại lơn hơn hoặc bằng 10',
//            'phone.max' => 'Nhập số điện thoại lớn là 12',
            'email.required' => 'Không được để trống email',
            'email.email' => 'Nhập đúng định dạng mail',
        ];
    }

}
