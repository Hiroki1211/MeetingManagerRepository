<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagIDRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'tagID' => 'required',
        ];
    }
    
    public function messages()
    {
        return [
            'tagID.required' => 'チェックは必須です',
        ];
    }
}
