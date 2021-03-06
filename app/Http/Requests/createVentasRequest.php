<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class createVentasRequest extends Request
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
        return  [
                'docrefe' => ['required', 'max:25'],
                'fechVenc' => ['required'],
                'tipoproduct' => ['required']

            ];
    }

    public function messages() 
    {
        return [

            'docrefe.required' => 'Por favor escribe el Documento de referencia',
            'docrefe.max' => 'El numero de documento de referencia no puede superar los 25 caracteres',
            'fechVenc.required' => 'La fecha de Vencimiento es Requerida',
            'tipoproduct.required' => 'El tipo de producto es Requerido'

        ];
    }
}
