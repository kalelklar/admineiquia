<?php

namespace sisadmineiquia\Http\Requests;

use sisadmineiquia\Http\Requests\Request;

class AsignacionAcademicaRequest extends Request
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
            //
        'idempleado'=>'required|not_in:0',
        'idciclo'=>'required|not_in:0',
        'anocarga'=>'required|not_in:0|max:5',
        'codigoasignatura'=>'required|max:6|regex:/^[aA-zZ]{3}\d{3}+$/i',
        'nombreasignatura'=>'required|max:50',
        'grupoteorico'=>'max:24',
        'grupolaboratorio'=>'max:24',
        'grupodiscusion'=>'max:24',
        'tiempototal'=>'required|numeric',
        'responsabilidadadministrativa'=>'max:100'
        ];
    }

    public function messages() { return [
        'idempleado.required' =>'El Empleado  es  obligatoria',
        'idempleado.not_in' =>'Escoja un Empleado  Valido',
        'idciclo.required' =>'El Nombre del Ciclo es  obligatoria',
        'idciclo.not_in' =>'El escoja un Nombre del Ciclo',
        'anocarga.required' =>'El año de la carga es obligatoria',
        'anocarga.not_in' =>'El Año de la carga debe ser vaido', 
        'codigoasignatura.required' =>'El codigo de la asignatura es obligatorio',
        'codigoasignatura.regex' =>'El formato del campo Codigo Asignatura es inválido debe ser XXX000.',
        'codigoasignatura.max' =>'El  campo Codigo Asignatura debe contener 6 caracteres como máximo.',
         'nombreasignatura.required'=>'El Nombre de la asignatura es obligatoria',
         'grupoteorico.max'=>'El campo del grupo teorico max de numeros 24',
         'grupodiscusion.max'=>'El campo del grupo de discusion max de numeros 24',
         'grupolaboratorio.max'=>'El campo del grupo de laboratorio max de numeros 2',
         'tiempototal.required'=>'El campo del tiempo total es obligatorio',
         'tiempototal.numeric'=>'El campo del Tiempo Total debe ser numerico',
         'responsabilidadadministrativa.max'=>'El campo de la Responsabilidad Administrativa tiene un maximo de 100 caracteres',
         ]; }
}
