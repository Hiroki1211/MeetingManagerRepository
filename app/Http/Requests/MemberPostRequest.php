<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberPostRequest extends FormRequest
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
            'user.name_last' => 'required|string',
            'user.name_first' => 'required|string',
            'user.name_last_read' => 'required|string',
            'user.name_first_read' => 'required|string',
            'user.password' => 'required',
        ];
    }
    
    public function messages()
    {
        return [
            'user.name_last' => '文字列での入力が必須です',
            'user.name_first' => '文字列での入力が必須です',
            'user.name_last_read' => '文字列での入力が必須です',
            'user.name_first_read' => '文字列での入力が必須です',
            'user.password' => '入力が必須です',
        ];
    }
}
