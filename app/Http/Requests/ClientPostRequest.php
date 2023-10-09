<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientPostRequest extends FormRequest
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
            'client.name_last' => 'required|string',
            'client.name_first' => 'required|string',
            'client.name_last_read' => 'required|string',
            'client.name_first_read' => 'required|string',
            'client.password' => 'required',
        ];
    }
    
    public function messages()
    {
        return [
            'client.name_last' => '文字列での入力が必須です',
            'client.name_first' => '文字列での入力が必須です',
            'client.name_last_read' => '文字列での入力が必須です',
            'client.name_first_read' => '文字列での入力が必須です',
            'client.password' => '入力が必須です',
        ];
    }
}
