<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class ClienteFormRequest extends Request
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
            'direccion'=>'max:45',
            'telefono'=>'required|max:45',
            'correo'=>'required|max:45',
            'documento'=>'required|max:45',
            'nit'=>'|max:45',
            'verificacion_nit'=>'max:45',
            'nombre_empresa'=>'max:45',
            'fecha'=>'required|max:45',
            'empleado_id_empleado'=>'required|max:45',
            'sede_id_sede'=>'required|max:45',
            'categoria_cliente_id_categoria'=>'required|max:45',
            //'cartera_activa'=>'required|max:45',
        ];
    }
}
