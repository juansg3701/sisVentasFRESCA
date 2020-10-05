<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class DetallePPFormRequest extends Request
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
        	'cantidad'=>'required|max:45', 
        	'precio_venta'=>'|max:45', 
        	'tp_aproveedor_id_rproveedor'=>'|max:45',
            'total'=>'|max:45', 
        	'producto_id_producto'=>'|max:45', 
        	'descuentos_id_descuento'=>'|max:45', 
        	'impuestos_id_impuestos'=>'|max:45',
        ];
    }
}
