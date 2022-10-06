<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveResultRequest extends FormRequest
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
            'element_code'=>['required','integer'],
            'hpv_code'=>'unique:results,hpv_code',

        ];
    }

    public function messages(){
        return[

            'hpv_code.unique' => 'Trùng mã hpv_code',

        ];
    }
}
