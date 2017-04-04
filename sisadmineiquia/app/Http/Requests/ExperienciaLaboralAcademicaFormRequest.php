<?php

namespace sisadmineiquia\Http\Requests;

use sisadmineiquia\Http\Requests\Request;

class ExperienciaLaboralAcademicaFormRequest extends Request
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
            'idexpedienteacadem'=>'required|not_in:0',
            'nombreinstitucionexplabacad'=>'required|max:50',
            'fechainicioexplabacad'=>'required|max:12|date',
            'fechafinalizacionexplabacad'=>'required|max:12|date|after:fechainicioexplabacad',
            'descripcionexplab'=>'max:200'
        ];
    }

    public function messages()
    {
        return [
                'idexpedienteacadem.required' =>'El campo Empleado es obligatorio',
                'idexpedienteacadem.not_in' =>'El campo Empleado debe ser valido',
                'nombreinstitucionexplabacad.required' =>'El campo Nombre Institucion es obligatorio',
                'fechainicioexplabacad.required' =>'El campo Fecha Inicio es obligatorio',
                'fechafinalizacionexplabacad.required' =>'El campo Fecha Fin es obligatorio',
                'fechainicioexplabacad.date' =>'El campo Fecha de Inicio debe ser tipo fecha',
                'fechafinalizacionexplabacad.after' =>'El campo Fecha de Fin debe ser mayor a la Fecha de inicio',
                'descripcionexplab.max'=>'El maximo de letras es 200 en la descriptcion de la experiencia'];
    }

}
