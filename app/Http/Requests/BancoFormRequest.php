<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class BancoFormRequest extends Request
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
            'nombre_banco'=>'required|max:45',
            'intereses'=>'required|max:45',
            'NoCuenta'=>'required|max:45',
            'tipo_cuenta_id_tcuenta'=>'required|max:45',
        ];
    }
}
