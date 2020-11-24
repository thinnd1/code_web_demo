<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyRequest extends FormRequest
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
            'name_shop' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'quantity_product' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name_shop.required' => 'Không được để trống tên công ty',
            'name_shop.unique' => 'Tên công ty đã tồn tại',
            'name_shop.min' => 'Nhập ký tự nhiều hơn 5',
            'name_shop.max' => 'Nhập ký tự ít hơn 20',
            'address.required' => 'Không được để trống địa chỉ',
            'quantity_product.required' => 'Không được để trống số lượng',
            'phone.required' => 'Không được để trống số điện thoại',
            'email.required' => 'Không được để trống email',
            'email.exist' => 'Nhập đúng định dạng mail',
            'email.unique' => 'Email đã tồn tại',
        ];
    }

}
