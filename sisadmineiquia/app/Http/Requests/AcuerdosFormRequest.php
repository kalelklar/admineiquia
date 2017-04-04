<?php

namespace sisadmineiquia\Http\Requests;

use sisadmineiquia\Http\Requests\Request;

class AcuerdosFormRequest extends Request
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
        'idacuerdo'=>'required|max:11|regex:/^[aA-zZ]{2}[-]{1}\d{3}[-]{1}\d{4}$/i',
        'idempleado'=>'required',
        'motivoacuerdo'=>'required|max:50',
        'descripcionacuerdo'=>'required|max:250',
        'fechaacuerdo'=>'required|max:10|regex:/^\d{2}-\d{2}-\d{4}$/',
        'archivoacuerdo'=>'mimes:pdf'
        ];
    }

    public function messages()
    {
        return ['idacuerdo.regex' =>'Formato del Código del acuerdo: AA-000-0000',
                'fechaacuerdo.regex'=>'Formato de Fecha del acuerdo: 00-00-0000',
                'archivoacuerdo.mimes'=>'Documento del acuerdo solo con extensión .pdf',
                'idacuerdo.max'=>'Código del acuerdo debe contener 11 caracteres como máximo',
                'motivoacuerdo.max'=>'Motivo del acuerdo debe contener 50 caracteres como máximo',
                'descripcionacuerdo.max'=>'Descripción del acuerdo debe contener 250 caracteres como máximo',
                'fechaacuerdo.max'=>'Fecha del acuerdo debe contener 10 caracteres como máximo',
                
        ];
    }
}
