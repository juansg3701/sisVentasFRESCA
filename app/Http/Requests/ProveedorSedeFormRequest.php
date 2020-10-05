<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class ProveedorSedeFormRequest extends Request
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
            'producto_id_producto'=>'required|max:45',
            'sede_id_sede'=>'required|max:45',
            'proveedor_id_proveedor'=>'required|max:45',
            'disponibilidad'=>'required|max:45',
            'cantidad'=>'required|max:45',

        ];
    }
}
