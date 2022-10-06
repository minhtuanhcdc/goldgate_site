<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveinforRequest extends FormRequest
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
        // return [
        //     'name'=>['required','string'],
        //     'birthday'=>['required','integer'],
        //     'thinprep_code'=>'unique:billtests,thinprep_code',
        //     'hpv_code'=>'unique:billtests,hpv_code',
        //     'genger'=>['nullable','integer'],
        //     'address'=>['required','string'],
        //     'status'=>['nullable','integer'],
        //     'ousent_id'=>['nullable','integer'],
        // ];

        return [
            'name'=>['required','string'],
            'birthday'=>['required','integer'],
            'thinprep_code'=>['nullable','unique:billtests,thinprep_code'],
            'hpv_code'=>['nullable','unique:billtests,hpv_code'],
            'sub_read_code'=>['nullable','string'],
            'genger'=>['nullable','integer'],
            'usercreate_id'=>['nullable','integer'],
            'userupdate_id'=>['nullable','integer'],
            'address'=>['required','string'],
            'status'=>['nullable','integer'],
            'sample_code'=>['nullable','integer'],
            'ousent_id'=>['nullable','integer'],
            'intra'=>['nullable','integer'],
            'radiation'=>['nullable','integer'],
            'hormone'=>['nullable','integer'],
            'preg'=>['nullable','integer'],
        ];
    }
    public function messages(){
        return[
            'name.required'=>'Nhập tên bệnh nhân',
            'address.required'=>'Nhập address',
            'thinprep_code.unique' => 'Trùng mã Thinrep_code',
            'hpv_code.unique' => 'Trùng mã hpv_code',
            'birthday.required'=>'Nhập năm sinh',
            'ousent_id.required'=>'Chọn đơn vị gửi mẫu',
        ];
    }
}
