<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class CorteSedeFormRequest extends Request
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
            'noproductos'=>'max:45',
            'valor_total'=>'max:45',
            'p_tiempo_id_tiempo'=>'required|max:45',
            'sede_id_sede'=>'required|max:45',
        ];
    }
}
