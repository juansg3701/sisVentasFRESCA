<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class NominaHor4FormRequest extends Request
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
            'desde'=>'required|max:45',
            'hasta'=>'required|max:45',
        ];
    }
}
