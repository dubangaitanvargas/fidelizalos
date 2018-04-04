<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateClientRequest extends Request
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
            'nombrecliemodal'  => ['required', 'max:100'],
            ##'address'  => ['required', 'max:255']
            'phone1'  => ['required', 'max:13'],
            'phone2'  => ['max:15'],
            'email'  => ['max:80']
        ];
    }

    public function messages()
    { 
        return[
        'nombrecliemodal.required' => 'El nombre del cliente es requerido',
        'nombrecliemodal.max' => 'Por favor ingresa un nombre menos de 255 caracteres',
        'phone1.required' => 'El numero de Celular es requerido',
        'phone1.max' => 'Debe ingresar un numero valido  menos de 10 digitos',
        'phone2.max' => 'Debe ingresar un numero valido  menos de 10 digitos'
    ];
    }
}
