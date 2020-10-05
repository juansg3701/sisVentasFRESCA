<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class ProductosCorteFormRequest extends Request
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
            'c_inventario_id_corte'=>'required|max:45',
            'fecha'=>'required|max:45',
            'producto_id_producto'=>'required|max:45',
        ];
    }
}
