<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class RCajaFormRequest extends Request
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
            'fechaInicial'=>'required|max:45',
            'fechaFinal'=>'required|max:45',
            'fechaActual'=>'required|max:45',
        ];
    }
}
