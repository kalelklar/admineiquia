<?php

namespace sisadmineiquia\Http\Requests;

use sisadmineiquia\Http\Requests\Request;

class PuestoFormRequest extends Request
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
            'nombrepuesto'=>'required|max:50',
            'iddepartamento'=>'required',
            'idperfilpuesto'=>'required',
            'descripcionpuesto'=>'max:250',
            'salariopuesto'=>'numeric',
        ];
    }
    public function messages()
    {
        return ['nombrepuesto.required' =>'El campo "Nombre de Puesto" es obligatorio',
                'iddepartamento.required' =>'El "campo Departamento" es obligatorio',
                'idperfilpuesto.required' =>'El Campo "Perfil del Puesto" es obligatorio',
                'salariopuesto.numeric.' =>'El campo "Salario Puesto" obligatorio',
                'descripcionpuesto.max' =>'El Campo "Descripcion" tiene un maximo de caracteres de 250'
            ];
    }
}
