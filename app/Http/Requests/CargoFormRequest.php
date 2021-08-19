<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class CargoFormRequest extends Request
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
            'descripcion'=>'required|max:45',
            'empleado_id_empleado'=>'|max:45',
            'fecha'=>'|max:45',
        ];
    }
}
