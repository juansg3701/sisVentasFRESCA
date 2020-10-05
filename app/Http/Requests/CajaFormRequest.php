<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class CajaFormRequest extends Request
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
            'base_monetaria'=>'required|max:45',
            'ingresos_efectivo'=>'required|max:45',
            'ingresos_electronicos'=>'required|max:45',
            'egresos_efectivo'=>'required|max:45',
            'egresos_electronicos'=>'required|max:45',
            'ventas'=>'required|max:45',
            'fecha'=>'required|max:45',
            'empleado_id_empleado'=>'required|max:45',
            'sede_id_sede'=>'required|max:45',
            'p_tiempo_id_tiempo'=>'required|max:45',
        ];
    }
}
