<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'cod_fs' =>  'required|string',
            'item' => 'required|string',
            'name' => 'required|string',
             'pronunciation_in_english' => 'required|string',
            'description' => 'required|string',
            'packsize' => 'required|string',
            'picture_url' => 'image|mimes:jpg,jpeg,png,gif|max:200',
            'category_id' => 'numeric|required',
            'unit_id' => 'numeric|required'

        ];
    }

    public function messages()
    {
        return [
            'cod_fs.required' => 'ingrese un codigo',
            'item.required' => 'ingrese un item',
            'name.required' => 'ingrese un nombre',
            'pronunciation_in_english.required' => 'ingrese un el texto de pronunciación',
            'description.required' => 'ingrese una descriptción',
            'packsize.required' => 'ingrese un tamaño de paquete',
            'picture_url.required' => 'seleccione un archivo imagen jpg,jpeg,png,gif o sobre pasa el peso establecido de 200k ',
            'category_id.required' => 'ingrese una categoria',
            'unit_id.required' => 'ingrese una unidad',



        ];
    }

}
