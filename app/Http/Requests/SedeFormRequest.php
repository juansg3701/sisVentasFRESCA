<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class SedeFormRequest extends Request
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
            'nombre_sede'=>'required|max:45',
            'ciudad'=>'required|max:45',
            'descripcion'=>'required|max:45',
            'direccion'=>'required|max:45',
            'telefono'=>'required|max:45',
        ];
    }
}
