<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventIDRequest extends FormRequest
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
            'eventID' => 'required',
        ];
    }
    
    public function messages()
    {
        return [
            'eventID.required' => 'チェックは必須です',
        ];
    }
}
