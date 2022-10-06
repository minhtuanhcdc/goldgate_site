<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveOuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
            'address'=>['required','string'],
            
            'phone'=>['nullable','tring'],
            'slug'=>['nullable','string'],
            'logo' => ['nullable', 'image', 'max:3000'],
           'person_contact'=>['nullable','string'],
           'id_ou'=>['nullable','string'],
        ];
    }
}
