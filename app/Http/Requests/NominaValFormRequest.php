<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class NominaValFormRequest extends Request
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
            'descripcion'=>'|max:45',
            'horaordinaria'=>'required|max:45',
            'horadominical'=>'required|max:45',
            'horaextra'=>'required|max:45',
            'horaextdom'=>'required|max:45',
            'fecha'=>'required|max:45',
            'no_horas'=>'|max:45',
            'pago_sem'=>'|max:45',
        ];
    }
}
