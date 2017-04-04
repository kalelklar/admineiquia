<?php

namespace sisadmineiquia\Http\Requests;

use sisadmineiquia\Http\Requests\Request;

class PerfilPuestoRequest extends Request
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
            'profesion'=>'required|max:50',
            'reporta'=>'required|max:100',
            'sustituto'=>'required|max:150',
            'relaciones'=>'required|max:150',
            'responsabilidades'=>'required',
            'sustituye'=>'required|max:50' 
        ];
    }

    public function messages()
    {
        return [
            'profesion.required'=>'El campo "Profesion" debe tener como maximo 250 caracteres',
            'reporta.required'=>'El campo "Reporta a" debe tener como maximo 100 caracteres',
            'sustituto.required'=>'El campo "Sustituto" debe tener como maximo 100 caracteres',
            'relaciones.required'=>'El campo "Relaciones" debe tener como maximo 150 caracteres',
            'responsabilidades.required'=>'El campo "Responsabilidades" es obligatorio', 
            'sustituye.required.max'=>'El campo "Sustitutye a" debe tener como maximo 50 caracteres'
        ];
    }
}
