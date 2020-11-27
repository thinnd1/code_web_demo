<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|min:5|max:30',
            'quantity' => 'required|numeric',
            'description' => 'required|min:5|max:1000',
            'price' => 'required|numeric|min:1',
            'type' => 'in:1,2,3,4',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Không được để trống tên sản phẩm',
            'name.min' => 'Nhập tên sản phẩm nhiều hơn 5',
            'name.max' => 'Nhập tên sản phẩm ít hơn 30',
            'quantity.required' => 'Không được để trống số lượng',
            'quantity.numeric' => 'Bạn phải nhập số',
            'description.required' => 'Không được để trống trường miêu tả sản phẩm',
            'description.min' => 'Nhập trường miêu tả sản phẩm nhiều hơn 5',
            'description.max' =>  'Nhập trường miêu tả sản phẩm ít hơn 500',
            'price.required' => 'Không được để trống giá',
            'price.numeric' => 'Bạn phải nhập số',
            'price.min' => 'Bạn phải nhập số lớn hơn 0',
            'type.in' => 'Bạn chọn loại sản phẩm không có trong danh mục'
        ];
    }
}
