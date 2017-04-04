<?php

namespace sisadmineiquia\Http\Requests;

use sisadmineiquia\Http\Requests\Request;

class TiempoAdicionalFormRequest extends Request
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
            'idempleado'=>'required',
            'idciclo'=>'required|max:1',
            'tiempoadicionalinicio'=>'required|max:12',
            'tiempoadicionalfin'=>'required|max:12|date|after:tiempoadicionalinicio',
            'ano'=>'required|max:4',
            'descripcion'=>'max:250'

        ];
    }


    public function messages()
    {
        return ['tiempoadicionalfin.required' =>'El campo Tiempo Adicional Fin es obligatorio',
                'tiempoadicionalinicio.required' =>'El campo Tiempo Adicional Inicio es obligatorio',
                'idempleado.required' =>'El Campo Empleado es obligatorio',
                'idciclo.required' =>'El Campo Codigo de Ciclo es obligatorio',
                'ano.required' =>'El Campo Año es obligatorio',
                'tiempoadicionalfin.after' =>'El campo Tiempo Adicional Fin debe ser mayor al Tiempo Adicional Inicio ',
                'descripcion.max' =>'El Campo Descripcion tiene un maximo de caracteres de 250',];
    }
}
