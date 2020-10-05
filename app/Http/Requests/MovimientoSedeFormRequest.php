<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class MovimientoSedeFormRequest extends Request
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
            //'id_sede'=>'required|max:45',
            'fecha'=>'required|max:45',
            'stock_id_stock'=>'required|max:45',
            'sede_id_sede'=>'required|max:45',
            'sede_id_sede2'=>'required|max:45',
            't_movimiento_id_tmovimiento'=>'required|max:45',
            'id_empleado'=>'required|max:45',

        ];
    }
}
