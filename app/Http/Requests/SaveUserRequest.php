<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveUserRequest extends FormRequest
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
            'name'=>['required','string'],
            'username'=>['required','string'],    
            'email'=>['nullable','email'],
            'phone'=>['nullable','numeric'],
            'image' => ['nullable', 'image', 'max:3000'],
           'profile_photo_path'=>['nullable','string'],
        ];
    }
}
