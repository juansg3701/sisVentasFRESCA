<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class DetalleBancoFormRequest extends Request
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
        	'fecha'=>'required|max:45', 
        	'ingreso_efectivo'=>'|max:45', 
        	'egreso_efectivo'=>'|max:45',
            'ingreso_electronico'=>'|max:45', 
            'egreso_electronico'=>'|max:45',
            'banco_idBanco'=>'|max:45',
            'sede_id_sede'=>'|max:45',
        ];
    }
}
