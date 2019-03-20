<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegister extends FormRequest
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

            'name' =>  'required|string',
            'email' =>  'required|email',
            'branch_office' =>  'required|string',
            'address' =>  'required|string',
            'mobile_phone' =>  'required|string',
            'landline' =>  'required|string'

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'escriba un nombre',
            'email.required' => 'escriba un email',
            'branch_office.required' => 'escriba una sucursal',
            'address.required' => 'escriba una dirección',
            'mobile_phone.required' => 'escriba un teléfono móvil',
            'landline.required' => 'escriba un teléfono fijo',


        ];
    }


}
