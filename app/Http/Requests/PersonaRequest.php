<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonaRequest extends FormRequest
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
            'tipo_documento' => 'integer',
            "documento" => 'integer|required|unique:personas',
            'nombres' => 'string|required',
            'apellidos' => 'string|required',
            'direccion' => 'string',
            'telefono' => 'string',
            'firma' => 'string',
        ];
    }
}
