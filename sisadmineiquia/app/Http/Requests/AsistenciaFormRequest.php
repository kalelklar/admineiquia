<?php

namespace sisadmineiquia\Http\Requests;

use sisadmineiquia\Http\Requests\Request;

class AsistenciaFormRequest extends Request
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
             'idexpediente',
             'idasistencia',
             'fechaasistencia'=>'required',
             'turno'=>'required',
             'horaentrada'=>'required',
             'horasalida'=>'required',
             'observaciones'
           
        ];
    }
}
