<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class NominaUsuFormRequest extends Request
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
            'nombre'=>'required|max:45',
            'tipo_cargo_id_cargo'=>'required|max:45',
            'sede_id_sede'=>'required|max:45', 
            'codigo'=>'max:45',
            'correo'=>'max:45',
            'contraseña'=>'max:45',
        ];
    }
}
