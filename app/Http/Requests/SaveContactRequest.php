<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveContactRequest extends FormRequest
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
            'google_map_url'=>['required','string'],
             'name'=>['required','string'],
             'address'=>['required','string'],
            'email'=>['required','email'],
            'phone'=>['required','string'],
            'contact_image'=>['nullable','image']
        ];
    }
}
