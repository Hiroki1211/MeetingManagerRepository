<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventPostRequest extends FormRequest
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
            'event.title' => 'required|string',
            'event.edit_limit' => 'required',
            'event.day_start' => 'required',
            'event.day_end' => 'required',
            'event.time_start' => 'required',
            'event.time_end' => 'required',
            'event.locate' => 'required|string',
        ];
    }
    
    public function messages()
    {
        return [
            'event.title' => '文字列の入力が必須です',
            'event.edit_limit' => '入力が必須です',
            'event.day_start' => '入力が必須です',
            'event.day_end' => '入力が必須です',
            'event.frame' => '入力が必須です',
            'event.time_start' => '入力が必須です',
            'event.time_end' => '入力が必須です',
            'event.locate' => '文字列の入力が必須です',
        ];
    }
}
