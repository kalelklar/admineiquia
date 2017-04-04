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
            'idexpediente'=>'required|not_in:0',
            'fechasolicitud'=>'required|date|max:10|min:10',
            'motivopermiso'=>'required|max:250',
            'tiemposolicitadohora'=>'required|numeric|min:0||max:72',
            'tiemposolicitadomin'=>'required|numeric|min:0|max:59',
            'gocesueldo'=>'required',
            'estadopermiso'=>'required',
            'fechapermiso'=>'required|date|after:fechasolicitud|max:10|min:10',
            //'cargoempleado'=>'required|max:50' 
        ];
    }

    public function messages()
    {
        return [
            'idexpediente.required'=>'El campo "Empleado" es obligatorio',
            'idexpediente.not_in'=>'El campo "Empleado" debe ser valido',
            'fechasolicitud.required'=>'El campo "Fecha Solicitud" es obligatorio',
            'fechasolicitud.date'=>'El campo "Fecha Solicitud" tiene que ser una fecha valida',
            'motivopermiso.required'=>'El campo "Motivo permiso" es obligatorio',
            'motivopermiso.max'=>'El campo "Motivo permiso" debe tener como maximo 250 caracteres',
            'tiemposolicitadohora.required'=>'El campo "tiempo solicitado : Horas" es obligatorio ',
            'tiemposolicitadohora.numeric'=>'El campo "tiempo solicitado : Horas" debe ser numerico y maximo 8 ',
            'tiemposolicitadohora.min'=>'El campo "tiempo solicitado : Horas" debe tener maximo 8 ',
            'tiemposolicitadohora.max'=>'El campo "tiempo solicitado : Horas" debe tener maximo de 72 horas ',
            'tiemposolicitadohora.numeric'=>'El campo "tiempo solicitado : Horas" debe ser numerico ',
            'tiemposolicitadomin.required'=>'El campo "tiempo solicitado : Minutos" es obligatorio',
            'tiemposolicitadomin.min'=>'El campo "tiempo solicitado : Minutos" debe ser numerico con minimo de "0"',
            'tiemposolicitadomin.max'=>'El campo "tiempo solicitado : Minutos" debe ser numerico con un maximo 59"',
            'tiemposolicitadomin.numeric'=>'El campo "tiempo solicitado : Minutos" debe ser numerico',
            'gocesueldo.required'=>'El campo "Goce de Sueldo" es obligatorio',
            'estadopermiso.required'=>'El campo "Estado permiso" es obligatorio',
            'fechapermiso.required'=>'El campo "Fecha Registro" es obligatorio',
            'fechapermiso.after'=>'El campo "Fecha Registro" debe ser una fecha posterior a  la "Fecha Solicitud"',
            'fechapermiso.date'=>'El campo "Fecha Registro" debe ser una fecha valida'
           // 'cargoempleado.required'=>'El campo "Cargo empleado" es obligatorio, Seleccione un Empleado'
        ];
    }
}
