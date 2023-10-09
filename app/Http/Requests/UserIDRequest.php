<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserIDRequest extends FormRequest
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
            'userID' => 'required',
        ];
    }
    
    public function messages()
    {
        return [
            'userID.required' => 'チェックは必須です',
        ];
    }
}
