<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class CategoriaFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        protected $connection = 'general';
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
            'nombre'=>'required|max:45',
            'descripcion'=>'required|max:45',
            'empleado_id_empleado'=>'required|max:45',
            'sede_id_sede'=>'required|max:45',
            'fecha'=>'required|max:45',
        ];
    }
}
