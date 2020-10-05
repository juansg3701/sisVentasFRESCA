<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class FacturaCobrarFormRequest extends Request
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
            'cuotas_totales'=>'required|max:45',
            'cuotas_restantes'=>'required|max:45', 
            'cliente_id_cliente'=>'required|max:45', 
            'empleado_id_empleado'=>'required|max:45', 
            'total'=>'required|max:45', 
            'fecha'=>'required|max:45',
            'atraso'=>'required|max:45',
            'factura_id_factura'=>'max:45',
        ];
    }
}
