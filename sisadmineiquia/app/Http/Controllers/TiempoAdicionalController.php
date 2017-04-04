<?php

namespace sisadmineiquia\Http\Controllers;

use Illuminate\Http\Request;

use sisadmineiquia\Http\Requests;

use sisadmineiquia\Empleado;

use sisadmineiquia\Ciclo;

use sisadmineiquia\Tiempo;

use sisadmineiquia\ExpedienteAdministrativo;

use Illuminate\Support\Facades\Redirect;

use sisadmineiquia\Http\Requests\TiempoAdicionalFormRequest;

use DB;

use Carbon\Carbon;

use Session;

class TiempoAdicionalController extends Controller
{
    //
     public function __construct(){

    } 

    public function index(Request $request)
    {
        if ($request)
        {
            $tiempos  = DB::table('tiempoadicional')->Select( DB::raw("
                tiempoadicional.idtiempo,tiempoadicional.idciclo,tiempoadicional.ano,tiempoadicional.fechainicio,tiempoadicional.fechafin,tiempoadicional.descripcion,
                expedienteadminist.idexpediente,empleado.idempleado,CONCAT(empleado.primernombre,' ', empleado.segundonombre,' ',empleado.primerapellido,' ', empleado.segundoapellido) as nombrecompleto"))
            ->join('expedienteadminist', 'tiempoadicional.idexpediente', '=', 'expedienteadminist.idexpediente')
            ->join('empleado', 'expedienteadminist.idempleado', '=', 'empleado.idempleado')->get();
            return view('admin.tiempo.index',["tiempos"=>$tiempos]);
        }
    }

    public function create()
    {
     
     $empleado  = DB::table('empleado')->Select( DB::raw("expedienteadminist.idexpediente,empleado.idempleado,CONCAT(empleado.primernombre,' ', empleado.segundonombre,' ',empleado.primerapellido,' ', empleado.segundoapellido) as nombrecompleto"))->join('expedienteadminist', 'empleado.idempleado', '=', 'expedienteadminist.idempleado')->get();

     $ciclo=Ciclo::all();
        
    return view("admin.tiempo.create",["empleados"=>$empleado,"ciclos"=>$ciclo]);
    }

   

    public function store(TiempoAdicionalFormRequest $request)
    {
        if ($request)
        {
            $query=trim($request->get('idempleado'));

            $empleado=Empleado::find($query);
            //var_dump($empleado);
            $expadmin  = DB::table('expedienteadminist')->select('idexpediente','idempleado')->where('idempleado','=',$query)->get();
            if ($expadmin){
                $tiempo=new Tiempo;
                $tiempo->idexpediente=$expadmin[0]->idexpediente;
                $tiempo->ano=$request->get('ano');
                $tiempo->idciclo=$request->get('idciclo');
                $tiempo->fechainicio=$request->get('tiempoadicionalinicio');
                $tiempo->fechafin=$request->get('tiempoadicionalfin');
                $tiempo->descripcion=$request->get('descripcion');
                $tiempo->save();
                Session::flash('store','El tiempo adicional fue anexado  correctamente!!!');
                return Redirect::to('admin/tiempo');
            }else{
                    Session::flash('store','aun no existe Expediente Administrativo del Empleado!!!');
                    return Redirect::to('admin/tiempo/create');
                }
        }

    }

    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
        $ciclos = DB::table('ciclo')->select('idciclo','nombreciclo')->get(); 
        $empleado  = DB::table('tiempoadicional')->Select( DB::raw("
                tiempoadicional.idtiempo,tiempoadicional.idciclo,tiempoadicional.ano,tiempoadicional.fechainicio,tiempoadicional.fechafin,tiempoadicional.descripcion,
                expedienteadminist.idexpediente,empleado.idempleado,CONCAT(empleado.primernombre,' ', empleado.segundonombre,' ',empleado.primerapellido,' ', empleado.segundoapellido) as nombrecompleto"))
            ->join('expedienteadminist', 'tiempoadicional.idexpediente', '=', 'expedienteadminist.idexpediente')
            ->join('empleado', 'expedienteadminist.idempleado', '=', 'empleado.idempleado')->where('tiempoadicional.idtiempo','=',$id)->get();
            return view('admin.tiempo.edit',["tiempo"=>Tiempo::findOrFail($id),"empleados"=>$empleado,"ciclos"=>$ciclos]);
        
    }

   
     public function update(TiempoAdicionalFormRequest $request, $id){

                        $affectedRows = tiempo::where('idtiempo','=',$id)
                        ->update([
                            'idciclo' =>$request->get('idciclo'),
                            'ano' =>$request->get('ano'),
                            'fechainicio' =>$request->get('tiempoadicionalinicio'),
                            'fechafin' =>$request->get('tiempoadicionalfin'),
                            'descripcion' =>$request->get('descripcion')
                            ]);
                         Session::flash('update','El Tiempo Adicional fue actualizado correctamente!!!');
                         return Redirect::to('admin/tiempo');
                }// END UPDATE


    public function destroy($id)
    {
        //
        $query=trim($id);
            $affectedRows = Tiempo::where('idtiempo','=',$query)->delete();
            Session::flash('destroy','¡El  Tiempo Adicional se ha eliminado correctamente!');
            return Redirect::to('admin/tiempo');
    }
}
