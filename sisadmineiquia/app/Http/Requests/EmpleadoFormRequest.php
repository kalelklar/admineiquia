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
        'segundoapellido'=>'max:50',
        'primerapellido'=>'required|max:50',
        'dui'=>'required|max:10',
        'nit'=>'required|max:20',
        'isss'=>'required|max:10',
        'afp'=>'required|max:12'
        ];
    }
}