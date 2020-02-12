<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeAddRequest extends FormRequest
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
            'name' => 'required|min:3',
            'email' => 'required|unique:employees,email',
            'phone' => 'required|min:11',
            'photo' => 'mimes:jpeg,bmp,png',
        ];
    }
//|email:rfc,dns
    public function messages()
    {
        return [
            'name.required' => 'Preencha o Campo Nome!',
            'name.min' => 'Campo Nome exige um mínimo de 3 letras!',
            'email.required' => 'Preencha o Campo email!',
            'email.unique' => 'Este e-mail já existe em nosso Registro',
            'phone.required' => 'Preencha o Campo telefone!',
            'phone.integer' => 'O Campo Telefone deve ser apenas numeros!',
            'phone.min' => 'O Campo Telefone deve Ter no mínimo 11 Dígitos!',
            'photo.mimes' => 'O Campo Foto dever um arquivo do tipo jpeg,bmp ou png!',
        ];
    }
}
