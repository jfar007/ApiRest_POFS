<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Authenticate extends FormRequest
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
            //
            'username' =>  'required|string',
            'password' =>  'required|string'

        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'usuario incorrecto',
            'password.required' => 'contraseña incorrecta'

        ];
    }


}
