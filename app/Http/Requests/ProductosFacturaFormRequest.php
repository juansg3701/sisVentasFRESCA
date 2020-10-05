<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class ProductosFacturaFormRequest extends Request
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
            'precio_venta'=>'required|max:45',
            'factura_id_factura'=>'required|max:45',
            'producto_id_producto'=>'required|max:45',
            'descuentos_id_descuento'=>'required|max:45',
            'impuestos_id_impuestos'=>'required|max:45',
            'total'=>'required|max:45',
        ];
    }
}
