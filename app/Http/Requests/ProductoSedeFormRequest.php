<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class ProductoSedeFormRequest extends Request
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
          
            'plu'=>'required|max:45',
            'ean'=>'max:45',
            'nombre'=>'required|max:45',
            'unidad_de_medida'=>'required|max:45',
            'precio_1'=>'required|max:45',
            'precio_2'=>'max:45',
            'precio_3'=>'max:45',
            'precio_4'=>'max:45',
            'costo_compra'=>'max:45',
            'impuestos_id_impuestos'=>'required|max:45',
            'stock_minimo'=>'required|max:45',
            'categoria_id_categoria'=>'required|max:45',
            'fecha_registro'=>'required|max:45',
            'empleado_id_empleado'=>'required|max:45',
            'necesita_peso'=>'required|max:45',
            'punto_venta_id_punto_venta'=>'required|max:45',
            'descuento_id_descuento'=>'required|max:45',
            'imagen'=>'required|max:45',
        ];
    }
}
