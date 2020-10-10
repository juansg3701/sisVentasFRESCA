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
        protected $connection = 'general';
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        protected $connection = 'general';
        return [
          
            'plu'=>'required|max:45',
            'ean'=>'max:45',
            'nombre'=>'required|max:45',
            'unidad_de_medida'=>'required|max:45',
            'precio'=>'required|max:45',
            'impuestos_id_impuestos'=>'required|max:45',
            'stock_minimo'=>'required|max:45',
            'categoria_id_categoria'=>'required|max:45',
        ];
    }
}
