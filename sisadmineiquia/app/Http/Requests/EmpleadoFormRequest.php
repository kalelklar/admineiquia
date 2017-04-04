<?php
namespace sisadmineiquia\Http\Requests;
use sisadmineiquia\Http\Requests\Request;


class EmpleadoFormRequest extends Request
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
        'primernombre'=>'required|max:50',
        'segundonombre'=>'max:50',
        'primerapellido'=>'required|max:50',
        'segundoapellido'=>'required|max:50',
        'primerapellido'=>'required|max:50',
        'dui'=>'required|max:10|regex:/^[0-9]{8}[-]{1}[0-9]{1}$/i',
        'nit'=>'required|max:20|regex:/^[0-9]{4}[-]{1}[0-9]{6}[-]{1}[0-9]{3}[-]{1}[0-9]{1}$/i',
        'isss'=>'required|max:9',
        'afp'=>'required|max:12',
        'sexo'=>'required|in:F,M',
        'foto' => 'mimes:jpeg,bmp,png'
        ];
    }


    public function messages()
    {
    	return ['primernombre.required' =>'El campo Primer Nombre es obligatorio',
    			'primerapellido.required' =>'El campo Primer Apellido es obligatorio',
    			'segundopellido.required' =>'El campo Segundo Apellido es obligatorio',
                'dui.required' =>'El campo Documento de Identidad es obligatorio',
                'nit.required' =>'El campo Numero de Identificaion Tributaria es obligatorio',
                'isss.required' =>'El campo Numero de Seguro Social es obligatorio',
                'afp.required' =>'El campo Numero de AFP es obligatorio',
    			'sexo.in'=>'Seleccione un Sexo Valido',
                'dui.regex' =>'El campo Documento de Identidad no cumple el formato 00000000-0',
                 'nit.regex' =>'El campo Numero de Identificacion Tributaria no cumple el formato 0000-000000-000-0'];
 	}

}


