<?php

namespace sisadmineiquia\Http\Controllers;

use Illuminate\Http\Request;
use sisadmineiquia\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use sisadmineiquia\Http\Requests\PermisoFormRequest;
use sisadmineiquia\Permiso;
use Carbon\Carbon;
use Session;
use DB;

class PermisoController extends Controller
{
   public function __construct()
    {

    }

    public function index(Request $request)
    {
        if ($request)
        {
            $permisos=DB::table('permiso as p')
            ->join('expedienteadminist as exp','exp.idexpediente','=','p.idexpediente')
            ->join('empleado as emp','emp.idempleado','=','exp.idempleado')
            ->select('exp.idexpediente','exp.idempleado','p.idpermiso','p.fechasolicitud','p.motivopermiso','p.tiemposolicitadohora','p.tiemposolicitadomin','p.gocesueldo','p.estadopermiso','p.fechapermiso',DB::raw("CONCAT(emp.primernombre,' ', emp.segundonombre,' ',emp.primerapellido,' ', emp.segundoapellido) as nombre"))
            ->get();
            
            return view('admin.permiso.index',["permisos"=>$permisos]);
        }
    }

    public function create()
    {   
        $empleados=DB::table('expedienteadminist as exp')
            ->join('empleado as emp','emp.idempleado','=','exp.idempleado')
            ->join('puesto as p','p.idpuesto','=','exp.idpuesto')
            ->select('exp.idexpediente','exp.idempleado','p.nombrepuesto',DB::raw("CONCAT(emp.primernombre,' ', emp.segundonombre,' ',emp.primerapellido,' ', emp.segundoapellido) as nombre"))->get();

    	return view("admin.permiso.create",["empleados"=>$empleados]);
    }

    public function store(PermisoFormRequest $request)
    {
        if ($request)
        {  
          $permiso=new Permiso;
          $permiso->idexpediente=$request->get('idexpediente');

          $permisos=DB::table('permiso as p')
            ->join('expedienteadminist as exp','exp.idexpediente','=','p.idexpediente')
            ->select('p.fechasolicitud')
            ->where('exp.idexpediente','=',$permiso->idexpediente)
            ->get();

          $date = Carbon::now()->year;
          $anyof1=$date;

          $nump=0;

            foreach ($permisos as $per)
            {     
                $f2=$per->fechasolicitud;
                $anyof2=$f2[6].$f2[7].$f2[8].$f2[9];
        
                if($anyof1==$anyof2){
                    $nump=$nump+1;
                }
            }
         
          if($nump>=5){

             Session::flash('store','¡El empleado ya ha alcanzado el maximo de permisos!'); 
             return Redirect::to('admin/permiso/create'); 
            }

            else{
             $permiso=new Permiso;
             $exp=$request->get('idexpediente');
            
             for($i=0; $i<strlen($exp); $i++)
             {
                if($exp[$i]!="_"){
                    $idexpediente[$i]=$exp[$i];
                    echo $idexpediente[$i];
                }
                else{
                    $i=strlen($exp);
                }                    
             }
             $idexpediente=implode($idexpediente);
             $permiso->idexpediente=$idexpediente;
             $permiso->fechasolicitud=$request->get('fechasolicitud');
             $permiso->motivopermiso=$request->get('motivopermiso');
             $permiso->tiemposolicitadohora=$request->get('tiemposolicitadohora');
             $permiso->tiemposolicitadomin=$request->get('tiemposolicitadomin');
             $permiso->gocesueldo=$request->get('gocesueldo');
             $permiso->estadopermiso=$request->get('estadopermiso');
             $permiso->fechapermiso=$request->get('fechapermiso');
             $permiso->save();

             Session::flash('store','¡El permiso se ha creado correctamente!');
             return Redirect::to('admin/permiso');
            }
        }
         else{
             return Redirect::to('admin/permiso/create');
            }
    }

    public function show($id)
    {
    
    }

    public function edit($id)
    {   
        $permiso=DB::table('permiso as p')
            ->join('expedienteadminist as exp','exp.idexpediente','=','p.idexpediente')
            ->join('empleado as emp','emp.idempleado','=','exp.idempleado')
            ->join('puesto as pt','pt.idpuesto','=','exp.idpuesto')
            ->select('exp.idexpediente','exp.idempleado','p.idpermiso','p.fechasolicitud','p.motivopermiso','p.tiemposolicitadohora',
                     'p.tiemposolicitadomin','p.gocesueldo','p.estadopermiso','p.fechapermiso','pt.nombrepuesto',
             DB::raw("CONCAT(emp.primernombre,' ', emp.segundonombre,' ',emp.primerapellido,' ', emp.segundoapellido) as nombre"))
            ->where('p.idpermiso','=',$id)
            ->get();

        $empleados=DB::table('expedienteadminist as exp')
            ->join('empleado as emp','emp.idempleado','=','exp.idempleado')
            ->join('puesto as p','p.idpuesto','=','exp.idpuesto')
            ->select('exp.idexpediente','exp.idempleado','p.nombrepuesto',DB::raw("CONCAT(emp.primernombre,' ', emp.segundonombre,' ',emp.primerapellido,' ', emp.segundoapellido) as nombre"))->get();
            
        return view("admin.permiso.edit",["permiso"=>$permiso,"empleados"=>$empleados]);
    }

    public function update(PermisoFormRequest $request,$id)
    {   
        
        $affectedRows = Permiso::where('idpermiso','=',$id)
        ->update([
            'fechasolicitud'=>$request->get('fechasolicitud'),
            'motivopermiso' =>$request->get('motivopermiso'),
            'tiemposolicitadohora' =>$request->get('tiemposolicitadohora'),
            'tiemposolicitadomin' =>$request->get('tiemposolicitadomin'),
            'gocesueldo'=>$request->get('gocesueldo'),
            'estadopermiso'=>$request->get('estadopermiso'),
            'fechapermiso'=>$request->get('fechapermiso')]);

        Session::flash('update','¡El permiso se ha actualizado correctamente!');       
        return Redirect::to('admin/permiso');
    }

    public function destroy($id)
    {
        $affectedRows = Permiso::where('idpermiso','=',$id)->delete();
        Session::flash('destroy','¡El permiso fue eliminado correctamente!');
        return Redirect::to('admin/permiso');    
    }

}
