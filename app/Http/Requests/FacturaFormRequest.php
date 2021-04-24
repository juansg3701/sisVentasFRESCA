<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class FacturaFormRequest extends Request
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
            'pago_total'=>'required|max:45',
            'noproductos'=>'max:45',
            'tipo_pago_id_tpago'=>'required|max:45',
            'empleado_id_empleado'=>'required|max:45',
            'cliente_id_cliente'=>'required|max:45',
            'facturaPaga'=>'max:45',
            'id_factura_web'=>'max:45',
            'fecha'=>'max:45',
            'empleado_id_domiciliario'=>'max:45',
            'sede_id_sede'=>'max:45',
            'anulacion'=>'max:45',
            'referencia_pago'=>'max:45',
            'tipo_web'=>'max:45',
        ];
    }
}
