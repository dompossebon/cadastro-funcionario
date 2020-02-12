<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeUpdRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name' => 'required|string|min:3',
            'email' => 'required',
            'phone' => 'required|integer|min:11',
        ];
    }
//|email:rfc,dns
    public function messages()
    {
        return [
            'name.required' => 'Preencha o Campo Nome!',
            'name.min' => 'Campo Nome exige um mínimo de 3 letras!',
            'email.required' => 'Preencha o Campo email!',
            'phone.required' => 'Preencha o Campo telefone!',
            'phone.integer' => 'O Campo Telefone deve ser apenas numeros!',
            'phone.min' => 'O Campo Telefone deve Ter no mínimo 11 Dígitos!',
        ];
    }
}
