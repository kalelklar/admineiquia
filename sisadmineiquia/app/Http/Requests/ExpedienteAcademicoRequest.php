<?php

namespace sisadmineiquia\Http\Requests;

use sisadmineiquia\Http\Requests\Request;

class ExpedienteAcademicoRequest extends Request
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
        'fechaaperturaexpacad'=>'required|max:10',
        'nombreinstitucion'=>'required|max:50',
        'tituloobtenido'=>'required|max:50',
        'direccioninstitucion'=>'required|max:60',
        'descripcionacademica'=>'max:200',
        'posgrados'=>'max:2000',
        'maestria'=>'max:100'
        ];
    }

    public function messages() { 
        return [
        'idempleado.required' =>'El Empleado  es  obligatoria',
        'idempleado.not_in' =>'El escoja un Empleado',
        'fechaaperturaexpacad.required' =>'La fecha de Apertura es  obligatoria', 
        'nombreinstitucion.required' =>'El campo Nombre de Institucion es obligatorio', 
        'tituloobtenido.required' =>'El campo Titulo Obtenido es obligatorio',
        'direccioninstitucion.required'=>'El campo direccion de institucion es obligatorio',
        'direccioninstitucion.max'=>'El campo Direccion de Institucion tiene un maximo de caracteres de 60',
        'descripcionacademica.max'=>'El campo descripcion academica tiene un limite de 200 letras',
        'posgrados.max'=>'El campo Postgrados tiene un limite de 2000 letras',
        'maestria.max' =>'El campo Maestria tiene un maximo de caracteres de 100',
         ]; 
     }
}
