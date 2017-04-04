<?php

namespace sisadmineiquia\Http\Controllers;

use Illuminate\Http\Request;

use sisadmineiquia\Http\Requests;

use sisadmineiquia\Empleado;

use sisadmineiquia\ExpedienteAcademico;

use sisadmineiquia\Ciclo;

use sisadmineiquia\CargaAcademica;

use Illuminate\Support\Facades\Redirect;

use sisadmineiquia\Http\Requests\AsignacionAcademicaRequest;

use DB;

use Carbon\Carbon;

use Session;

use Illuminate\Support\Facades\Input;

use PDF;

use Illuminate\Http\Response;

class AsignacionAcademicaController extends Controller
{
    

    public function __construct(){ }



public function index(Request $request){
        
        if ($request)
        {
            $cargaacad=DB::table('asignacionacademic')->Select( DB::raw("asignacionacademic.idasignacionacad,asignacionacademic.codasignatura,asignacionacademic.nombreasignatura,asignacionacademic.idciclo,asignacionacademic.ano,expedienteacademic.idexpedienteacadem,expedienteacademic.fechaaperturaexpacad,expedienteacademic.tituloobtenido,empleado.idempleado,CONCAT(empleado.primernombre,' ', empleado.segundonombre,' ',empleado.primerapellido,' ', empleado.segundoapellido) as nombrecompleto,empleado.dui,empleado.nit,empleado.estado,empleado.foto"))->join('expedienteacademic', 'asignacionacademic.idexpedienteacadem', '=', 'expedienteacademic.idexpedienteacadem')->join('empleado', 'expedienteacademic.idempleado', '=', 'empleado.idempleado')->get();
            return view('admin.cargaacademica.index',["cargaacademicas"=>$cargaacad]);
        }
    }//Final del Index



 public function create()
    {
     
     $ciclo=Ciclo::all();

     $empleado  = DB::table('empleado')->Select( DB::raw("expedienteacademic.idexpedienteacadem,empleado.idempleado,CONCAT(empleado.primernombre,' ', empleado.segundonombre,' ',empleado.primerapellido,' ', empleado.segundoapellido) as nombrecompleto"))->join('expedienteacademic', 'empleado.idempleado', '=', 'expedienteacademic.idempleado')->get();    
    return view("admin.cargaacademica.create",["empleados"=>$empleado,"ciclos"=>$ciclo]);
    } //Fin de create


 public function store(AsignacionAcademicaRequest $request){
    
            $query=trim($request->get('idempleado'));    
            $empleado=Empleado::find($query);
             $expacad = DB::table('expedienteacademic')->select('idexpedienteacadem')->where('idempleado','=',$query)->get();

           if($expacad!=null){
                    $cargaacademica=new CargaAcademica;
                    $p1=ucfirst($empleado->PRIMERAPELLIDO);
                    $p2=ucfirst($empleado->SEGUNDOAPELLIDO);
                    $ac="AC";
                    $cargaacademica->idexpedienteacadem=$ac.$p1[0].$p2[0].$request->get('idempleado');
                    $cargaacademica->idciclo=$request->get('idciclo');
                    $cargaacademica->ano=$request->get('anocarga');
                    $cargaacademica->codasignatura=$request->get('codigoasignatura');
                    $cargaacademica->nombreasignatura=$request->get('nombreasignatura');
                    $cargaacademica->gteorico=$request->get('grupoteorico');
                    $cargaacademica->gdiscusion=$request->get('grupodiscusion');
                    $cargaacademica->glaboratorio=$request->get('grupolaboratorio');
                     $cargaacademica->tiempototal=$request->get('tiempototal');
                    $cargaacademica->responsabilidadadmin=$request->get('responsabilidadadministrativa');
                    $cargaacademica->save();
                   Session::flash('store','La carga Academica fue creada corectamente!!!');
                    return Redirect::to('admin/cargaacademica');
                }else{
                    Session::flash('store','El Empleado no Posee un Expediente Academico!!!');
                }// Fin de la funcion que verifica si posee Expediente academico


    }//Fin Store

     public function show($id)
    {
        return view("admin.cargaacademica.show",["cargaacademica"=>CargaAcademica::findOrFail($id)]);
    }

    public function edit($id)

    { 


        $ciclos = DB::table('ciclo')->select('idciclo','nombreciclo')->get(); 

        $empleados=DB::table('asignacionacademic')->Select( DB::raw("asignacionacademic.idasignacionacad,asignacionacademic.idciclo,asignacionacademic.ano,asignacionacademic.codasignatura,asignacionacademic.nombreasignatura,asignacionacademic.gteorico,asignacionacademic.gdiscusion,asignacionacademic.glaboratorio,asignacionacademic.tiempototal,asignacionacademic.responsabilidadadmin,expedienteacademic.idexpedienteacadem,expedienteacademic.fechaaperturaexpacad,expedienteacademic.tituloobtenido,empleado.idempleado,CONCAT(empleado.primernombre,' ', empleado.segundonombre,' ',empleado.primerapellido,' ', empleado.segundoapellido) as nombrecompleto,empleado.dui,empleado.nit,empleado.estado,empleado.foto"))
        ->join('expedienteacademic', 'asignacionacademic.idexpedienteacadem', '=', 'expedienteacademic.idexpedienteacadem')
        ->join('empleado', 'expedienteacademic.idempleado', '=', 'empleado.idempleado')->where('idasignacionacad','=',$id)->get();

        return view("admin.cargaacademica.edit",["cargaacademica"=>CargaAcademica::findOrFail($id),"empleados"=>$empleados,"ciclos"=>$ciclos]);
    }//Fin del EDIT



    public function update(AsignacionAcademicaRequest $request, $id){

                        $affectedRows = CargaAcademica::where('idasignacionacad','=',$id)
                        ->update([
                            'ano' =>$request->get('anocarga'),
                            'idciclo' =>$request->get('idciclo'),
                            'codasignatura' =>$request->get('codigoasignatura'),
                            'nombreasignatura' =>$request->get('nombreasignatura'),
                            'gteorico' =>$request->get('grupoteorico'),
                            'gdiscusion' =>$request->get('grupodiscusion'),
                            'glaboratorio' =>$request->get('grupolaboratorio'),
                            'tiempototal' =>$request->get('tiempototal'),
                            'responsabilidadadmin' =>$request->get('responsabilidadadministrativa'),
                            ]);
                         Session::flash('update','La carga fue actualizada correctamente!!!');
                         return Redirect::to('admin/cargaacademica');
                }// END UPDATE
                
    public function destroy($id)
    {
        $query=trim($id);
            $affectedRows = CargaAcademica::where('idasignacionacad','=',$query)->delete();
            Session::flash('destroy','¡La Carga Academica se ha eliminado correctamente!');
            return Redirect::to('admin/cargaacademica');
    }


    public function asignacionacadreport($id){
       $empleados=DB::table('asignacionacademic')->Select( DB::raw("asignacionacademic.idasignacionacad,asignacionacademic.codasignatura,asignacionacademic.nombreasignatura,asignacionacademic.idciclo,asignacionacademic.ano,expedienteacademic.idexpedienteacadem,expedienteacademic.fechaaperturaexpacad,expedienteacademic.tituloobtenido,empleado.idempleado,CONCAT(empleado.primernombre,' ', empleado.segundonombre,' ',empleado.primerapellido,' ', empleado.segundoapellido) as nombrecompleto,empleado.dui,empleado.nit,empleado.estado,empleado.foto"))->join('expedienteacademic', 'asignacionacademic.idexpedienteacadem', '=', 'expedienteacademic.idexpedienteacadem')->join('empleado', 'expedienteacademic.idempleado', '=', 'empleado.idempleado')->where('idasignacionacad','=',$id)->get();
       
       $asignacionacad=DB::table('asignacionacademic')->select(DB::raw("idasignacionacad,idexpedienteacadem,idciclo,ano,codasignatura,nombreasignatura,gteorico,gdiscusion,glaboratorio,tiempototal,responsabilidadadmin"))->where('idasignacionacad', '=', $id)->get();
       
       $pdf = PDF::loadView('admin.cargaacademica.show',["empleado"=>$empleados,"cargaacademica"=>$asignacionacad]);
       $papel_tamaño = array(0,0,216,279);
       $pdf->setPaper("letter" ,'portrait');
       return $pdf->stream('carga-Academica.pdf');
       
    }//FIN asignacionacadreport


    
} //Llave Final
