<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class UsersFormRequest extends Request
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
            'name'=>'required|max:255',
            'email'=>'required|max:255',
            'password'=>'required|max:255',
            'tipo_cargo_id_cargo'=>'required|max:45',
            'sede_id_sede'=>'required|max:45',
            'superusuario'=>'max:45',
        ];
    }
}
