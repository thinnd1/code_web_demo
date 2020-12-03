<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportCsvRequest extends FormRequest
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
            'file'      => 'required',
        ];
    }
    public function messages()
    {
        return [
            'file.required' => 'Không được để trống',
            'file.in'       => 'Nhập không đúng định dạng file csv',
        ];
    }
}
