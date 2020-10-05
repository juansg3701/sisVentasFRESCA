<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class UsuarioFormRequest extends Request
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
            'nombre'=>'required|max:45',
            'correo'=>'required|max:45',
            'contrasena'=>'required|max:45',
            'tipo_cargo_id_cargo'=>'required|max:45',
            'sede_id_sede'=>'required|max:45', 
            'codigo'=>'max:45',
            'contrasena2'=>'required|max:45',

        ];
    }
}
