<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class PedidoClienteFormRequest extends Request
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
        	'noproductos'=>'|max:45', 
        	'fecha_solicitud'=>'required|max:45', 
        	'fecha_entrega'=>'required|max:45', 
        	'pago_inicial'=>'|max:45', 
        	'porcentaje_venta'=>'|max:45', 
        	'pago_total'=>'|max:45', 
        	'cliente_id_cliente'=>'required|max:45', 
        	'empleado_id_empleado'=>'required|max:45', 
        	'tipo_pago_id_tpago'=>'required|max:45',
        ];
    }
}
