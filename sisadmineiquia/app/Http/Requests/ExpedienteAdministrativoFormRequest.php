<?php

namespace sisadmineiquia\Http\Requests;

use sisadmineiquia\Http\Requests\Request;

class ExpedienteAdministrativoFormRequest extends Request
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
        'idempleado'=>'required',
        'fechaapertura'=>'required|max:50',
        'codigocontrato'=>'required|max:11|regex:/^[aA-zZ]{2}[-]{1}\d{3}[-]{1}\d{4}$/i',
        'idpuesto'=>'required',
        'modalidadcontratacion'=>'required|max:60'
        ];
    }

    public function messages()
    {
        return ['fechaApertura.required' =>'El campo Fecha Apertura es obligatorio',
                'codigocontrato.required' =>'El campo Codigo de Acuerdo es obligatorio',
                'idpuesto.required' =>'El Campo Puesto es obligatorio',
                'idempleado.required' =>'El Campo Empleado es obligatorio',
                'modalidadcontratacion.required' =>'El Campo Modalidad Contratacion es obligatorio',
                'codigocontrato.regex' =>'Formato del Código de Contrato: AA-000-0000'
               ];
    }
}
