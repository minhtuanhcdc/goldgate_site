<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveOureadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
         return [
            'name'=>['required','string'],
            'read_code'=>['required','string','unique:oureads'],
            'phone'=>['nullable','tring'],
            'asign'=>['nullable','tring'],
            'asign_hpv'=>['nullable','integer'],
            'title'=>['nullable','tring'],

        ];
    }

    public function messages(){
        return[
            'name.required'=>'Nhập tên Đơn vị gửi',
            'read_code.required'=>'Nhập mã code',
            'read_code.unique'=>'Trùng mã đơn vị',

        ];
    }
}
