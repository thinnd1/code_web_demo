<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'id_user' => 'exists:customers,username',
            'id_product' => 'required|min:5|max:60',
            'total_price' => 'required|numeric|min:0',
            'email' => ['required','regex: /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
            'phone' => ['required','regex: /^\+?\d{10,11}$/i'],
            'orderdate' => 'required|date|date_format:Y-m-d',
            'address' => 'required|max:500',
            'payment' => 'in: 1,2,3',
            'order_status' => 'in: 1,2,3,4',
        ];
    }
    public function messages()
    {
        return [
            'id_user.exists' => 'Tên không tồn tại',

            'id_product.required' => 'Không được để trống sản phẩm',
            'id_product.min' => 'Nhập tên sản phẩm nhiều hơn 5 ký tự',
            'id_product.max' => 'Nhập tên sản phẩm ít hơn 60 ký tự',

            'email.required' => 'Không được để trống email',
            'email.regex' => 'Email sai định dạng',

            'phone.required' => 'Không được để trống số điện thoại',
            'phone.regex' => 'Số điện thoại nhập không đùng',

            'total_price.required' => 'Không được để trống tổng tiền',
            'total_price.numeric' => 'Tổng tiền cần nhập số',
            'total_price.min' => 'Tuổi nhập số dương',

            'orderdate.required' => 'Không được để trống ngày đặt',
            'orderdate.date' => 'Nhập đúng định dạng năm ngày tháng',
            'orderdate.date_format' => 'Nhập đúng định dạng năm ngày tháng',

            'address.required' => 'Không được để trống địa chỉ',
            'address.max' => 'Nhập địa chỉ ít hơn 500 ký tự',

            'payment.in' => 'Chọn đúng hình thức thanh toán',
            'order_status.in' => 'Chọn đúng hình thức order',
        ];
    }
}
