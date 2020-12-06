<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class DescuentosFormRequest extends Request
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
       
            'nombre'=>'required|max:45',
            'descripcion'=>'required|max:45',
            'valor_descuento'=>'required|max:45',
            'sede_id_sede'=>'required|max:45',
            'sede_id_sede'=>'required|max:45',
            'empleado_id_empleado'=>'required|max:45',
            'fecha'=>'required|max:45',
        ];
    }
}
