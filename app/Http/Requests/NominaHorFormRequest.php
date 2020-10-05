<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class NominaHorFormRequest extends Request
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
            'horaentrada'=>'required|max:45',
            'horasalida'=>'required|max:45',
            'jornada'=>'required|max:45',
            'empleado_id_empleado'=>'required|max:45',
        ];
    }
}
