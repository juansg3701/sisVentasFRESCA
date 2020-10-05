<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class AbonoPPFormRequest extends Request
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
            'tp_aproveedor_id_rproveedor'=>'required|max:45',
        	'abono'=>'required|max:45', 
        	'restante'=>'|max:45', 
        	'total'=>'|max:45', 
        	'fecha'=>'required|max:45', 
        	'empleado_id_empleado'=>'required|max:45', 
        	'tipo_pago_id_tpago'=>'required|max:45',
        ];
    }
}
