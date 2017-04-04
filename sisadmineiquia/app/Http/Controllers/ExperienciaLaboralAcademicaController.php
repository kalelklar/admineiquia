<?php

namespace sisadmineiquia\Http\Controllers;

use Illuminate\Http\Request;

use sisadmineiquia\Http\Requests;

use sisadmineiquia\Empleado;

use sisadmineiquia\ExperienciaLaboralAcademica;

use Illuminate\Support\Facades\Redirect;

use sisadmineiquia\Http\Requests\ExperienciaLaboralAcademicaFormRequest;

use DB;

use Carbon\Carbon;

use Session;

class ExperienciaLaboralAcademicaController extends Controller
{
    //
    public function __construct(){

    }

    

    public function index(Request $request){
    	/*$users = DB::table('users')
            ->join('contacts', 'users.id', '=', 'contacts.user_id')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('users.*', 'contacts.phone', 'orders.price')
            ->get();*/

        if ($request)
        {
            $experiencia=DB::table('experiencialaboral')->Select( DB::raw("experiencialaboral.idexplabacademica,experiencialaboral.descripcionexplab,experiencialaboral.nombreinstitucionexplabacad,experiencialaboral.fechainicioexplabacad,experiencialaboral.fechafinalizacionexplabacad,expedienteacademic.idexpedienteacadem,empleado.idempleado,CONCAT(empleado.primernombre,' ', empleado.segundonombre,' ',empleado.primerapellido,' ', empleado.segundoapellido) as nombrecompleto"))->join('expedienteacademic', 'experiencialaboral.idexpedienteacadem', '=', 'expedienteacademic.idexpedienteacadem')->join('empleado', 'expedienteacademic.idempleado', '=', 'empleado.idempleado')->get();
            return view('admin.experiencialaboralacademica.index',["experiencias"=>$experiencia]);
            
        }
    }

    public function create(){
        // Llamamos a Empleado, utilizamos el método select y le pasamos el $raw almacenado en la linea superior.
        $empleado  = DB::table('empleado')->Select( DB::raw("expedienteacademic.idexpedienteacadem,empleado.idempleado,CONCAT(empleado.primernombre,' ', empleado.segundonombre,' ',empleado.primerapellido,' ', empleado.segundoapellido) as nombrecompleto"))->join('expedienteacademic', 'empleado.idempleado', '=', 'expedienteacademic.idempleado')->get();
        
        return view("admin.experiencialaboralacademica.create",["empleados"=>$empleado]);
    }

    public function store(ExperienciaLaboralAcademicaFormRequest $request){
        
        
        if ($request)
        {
            $query=trim($request->get('idexpedienteacadem'));
            //var_dump($empleado);
            $expacad  = DB::table('expedienteacademic')->select('idexpedienteacadem')->where('idexpedienteacadem','=',$query)->get();
            if ($expacad){
                    $experiencia=new ExperienciaLaboralAcademica;
                    $experiencia->idexpedienteacadem=$query;
                    $experiencia->descripcionexplab=$request->get('descripcionexplab');
                    $experiencia->nombreinstitucionexplabacad=$request->get('nombreinstitucionexplabacad');
                    $experiencia->fechainicioexplabacad=$request->get('fechainicioexplabacad');
                    $experiencia->fechafinalizacionexplabacad=$request->get('fechafinalizacionexplabacad');
                    $experiencia->save();
                    Session::flash('store','Experiencia Laboral academica creado correctamente!!!');
                    return Redirect::to('admin/experiencialaboralacademica');
            }else{
                Session::flash('store','El Expediente academico del empleado no existe !!!');
                }
        }
        return Redirect::to('admin/experiencialaboralacademica/create');

    }
    public function show($id){
        return view("admin.empleado.show",["empleado"=>Empleado::findOrFail($id)]);
    }

    public function edit($id){
        /*****/
        $query=trim($id);
        $empleado=DB::table('experiencialaboral')->Select( DB::raw("experiencialaboral.idexplabacademica,experiencialaboral.descripcionexplab,experiencialaboral.nombreinstitucionexplabacad,experiencialaboral.fechainicioexplabacad,experiencialaboral.fechafinalizacionexplabacad,expedienteacademic.idexpedienteacadem,empleado.idempleado,CONCAT(empleado.primernombre,' ', empleado.segundonombre,' ',empleado.primerapellido,' ', empleado.segundoapellido) as nombrecompleto"))->join('expedienteacademic', 'experiencialaboral.idexpedienteacadem', '=', 'expedienteacademic.idexpedienteacadem')->join('empleado', 'expedienteacademic.idempleado', '=', 'empleado.idempleado')->where('idexplabacademica','=',$id)->get();
        return view("admin/experiencialaboralacademica.edit",["experiencialaboralacademica"=>ExperienciaLaboralAcademica::findOrFail($query),"empleados"=>$empleado]);
            
    }

    public function update(ExperienciaLaboralAcademicaFormRequest $request, $id){
        //dd($request->get('tiempointegral'));
        //dd($id);

        $affectedRows = ExperienciaLaboralAcademica::where('idexplabacademica','=',$id)
                        ->update([
                            'descripcionexplab' =>$request->get('descripcionexplab'),
                            'nombreinstitucionexplabacad' =>$request->get('nombreinstitucionexplabacad'),
                            'fechainicioexplabacad' =>$request->get('fechainicioexplabacad'),
                            'fechafinalizacionexplabacad' =>$request->get('fechafinalizacionexplabacad')
                            ]);
                         Session::flash('update','La Experiencia Laboral Academica fue actualizada correctamente!!!');
                         return Redirect::to('admin/experiencialaboralacademica');
    }
}
