<?php

namespace sisadmineiquia\Http\Requests;

use sisadmineiquia\Http\Requests\Request;

class PermisoFormRequest extends Request
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
            'idexpediente'=>'required',
            'idexpediente'=>'required|not_in:0',
            'fechasolicitud'=>'required|date|max:10|min:10',
            'motivopermiso'=>'required|max:250',
            'tiemposolicitadohora'=>'required|numeric|min:0|max:7',
            'tiemposolicitadomin'=>'required|numeric|min:0|max:59',
            'gocesueldo'=>'required',
            'estadopermiso'=>'required',
            'fechapermiso'=>'required|date|max:10|min:10|after:fechasolicitud',
            'year'=>'required|min:3',
        ];
    }

    public function messages()
    {
        return [ 
            'idexpediente.required'=>'Debe seleccionar un empleado',
            'idexpediente.not_in'=>'El campo "Empleado" debe ser valido',

            'fechasolicitud.required'=>'El campo "Fecha Solicitud" es obligatorio',
            'fechasolicitud.min.max'=>'El campo "Fecha Solicitud" debe tener 10 Caracteres',
            'fechasolicitud.date'=>'El campo "Fecha Solicitud" tiene que ser una fecha valida',

            'motivopermiso.required'=>'El campo "Motivo permiso" es obligatorio',
            'motivopermiso.max'=>'El campo "Motivo permiso" debe tener como maximo 250 caracteres',
            
            'tiemposolicitadohora.required'=>'El campo "tiempo solicitado : Horas" es obligatorio ',
            'tiemposolicitadohora.numeric'=>'El campo "tiempo solicitado : Horas" debe ser numerico',
            'tiemposolicitadohora.min.max'=>'El campo "tiempo solicitado : Horas" debe ser numerico de "0 a 7" horas',

            'tiemposolicitadomin.required'=>'El campo "tiempo solicitado" es obligatorio',
            'tiemposolicitadomin.numeric'=>'El campo "tiempo solicitado : Minutos" debe ser numerico',
            'tiemposolicitadomin.min.max'=>'El campo "tiempo solicitado : Minutos" debe ser numerico de "0 a 59" Minutos',
            
            'gocesueldo.required'=>'El campo "Goce de Sueldo" es obligatorio',
            'estadopermiso.required'=>'El campo "Estado permiso" es obligatorio',

            'fechapermiso.required'=>'El campo "Fecha Registro" es obligatorio',
            'fechapermiso.date'=>'El campo "Fecha Registro" debe ser una fecha valida',
            'fechapermiso.min.max'=>'El campo "Fecha Permiso" debe tener 10 Caracteres',
            'fechapermiso.after'=>'El campo "Fecha Registro" debe ser una fecha posterior a  la "Fecha Solicitud"',
        ];
    }
}
