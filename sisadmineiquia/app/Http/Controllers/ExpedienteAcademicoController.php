<?php

namespace sisadmineiquia\Http\Controllers;

use Illuminate\Http\Request;

use sisadmineiquia\Http\Requests;

use sisadmineiquia\Empleado;

use sisadmineiquia\ExpedienteAcademico;

use Illuminate\Support\Facades\Redirect;

use sisadmineiquia\Http\Requests\ExpedienteAcademicoRequest;

use DB;

use Carbon\Carbon;

use Session;



class ExpedienteAcademicoController extends Controller
{
    
 public function __construct(){ }


public function index(Request $request){
        //dd($request);
        if ($request)
        {
                      
            $expedienteacad=DB::table('expedienteacademic')->Select( DB::raw("expedienteacademic.idexpedienteacadem,expedienteacademic.fechaaperturaexpacad,expedienteacademic.tituloobtenido,empleado.idempleado,CONCAT(empleado.primernombre,' ', empleado.segundonombre,' ',empleado.primerapellido,' ', empleado.segundoapellido) as nombrecompleto,empleado.dui,empleado.nit,empleado.estado,empleado.foto"))->join('empleado', 'expedienteacademic.idempleado', '=', 'empleado.idempleado')->get();
            
            return view('admin.expedienteacademico.index',["expedienteacademicos"=>$expedienteacad]);
            
        }
    }

    public function create(){
       
        $raw = DB::raw("idempleado,CONCAT(primernombre,' ', segundonombre,' ',primerapellido,' ', segundoapellido) as nombrecompleto");
        $empleado  = Empleado::select($raw)->get();
        return view("admin.expedienteacademico.create",["empleados"=>$empleado]);
    }

     public function store(ExpedienteAcademicoRequest $request){
        //dd($request);
        
        
        if ($request)
        {
            $query=trim($request->get('idempleado'));
            

            $empleado=Empleado::find($query);
            
            $expacad = DB::table('expedienteacademic')->select('idempleado')->where('idempleado','=',$query)->get();


            if ($expacad){
                Session::flash('store','El Expediente ya existe!!!');
            }else{
                    $p1=ucfirst($empleado->PRIMERAPELLIDO);
                    $p2=ucfirst($empleado->SEGUNDOAPELLIDO);
                    $ac="AC";
                    $expedienteacademico=new ExpedienteAcademico;
                    $expedienteacademico->idexpedienteacadem=$ac.$p1[0].$p2[0].$request->get('idempleado');
                    $expedienteacademico->idempleado=$request->get('idempleado');
                    $expedienteacademico->fechaaperturaexpacad=$request->get('fechaaperturaexpacad');
                    $expedienteacademico->nombreinstitucion=$request->get('nombreinstitucion');
                    $expedienteacademico->anotitulacion=$request->get('anotitulacion');
                    $expedienteacademico->tituloobtenido=$request->get('tituloobtenido');
                    $expedienteacademico->tituloestudio=$request->get('maestria');
                    $expedienteacademico->direccioninstitucion=$request->get('direccioninstitucion');
                    $expedienteacademico->postgrados=$request->get('postgrados');
                    $expedienteacademico->descripcionacademica=$request->get('descripcionacademica');
                    $expedienteacademico->save();
                    Session::flash('store','El Expediente creado correctamente!!!');
                    return Redirect::to('admin/expedienteacademico');
                }
        }
        return Redirect::to('admin/expedienteacademico/create');

    }

    public function show($id){
        $expedienteacad=DB::table('expedienteacademic')->Select( DB::raw("expedienteacademic.idexpedienteacadem,expedienteacademic.fechaaperturaexpacad,expedienteacademic.nombreinstitucion,expedienteacademic.tituloobtenido,tituloestudio,expedienteacademic.direccioninstitucion,expedienteacademic.descripcionacademica,expedienteacademic.postgrados,
        empleado.idempleado,CONCAT(empleado.primernombre,' ', empleado.segundonombre,' ',empleado.primerapellido,' ', empleado.segundoapellido) as nombrecompleto,empleado.estado,empleado.foto"))
        ->join('empleado', 'expedienteacademic.idempleado', '=', 'empleado.idempleado')
        ->where('idexpedienteacadem','=',$id)->get();

        $queryexplabacad = DB::raw("idexplabacademica,descripcionexplab,nombreinstitucionexplabacad,fechainicioexplabacad,fechafinalizacionexplabacad");
        $explabacad=DB::table('experiencialaboral')->select($queryexplabacad)
        ->where('idexpedienteacadem', '=',$id)->get();

        $queryasignacion = DB::raw("idasignacionacad,idciclo,ano,codasignatura,nombreasignatura,gteorico,gdiscusion,glaboratorio,tiempototal,responsabilidadadmin");
        $asignacion=DB::table('asignacionacademic')->select($queryasignacion)
        ->where('idexpedienteacadem', '=',$id)->orderBy('ano', 'desc')->orderBy('idciclo', 'desc')->get();;

        return view("admin.expedienteacademico.show",["expedienteacademico"=>$expedienteacad,"experiencialaboral"=>$explabacad,"asignacionacademica"=>$asignacion]);
    }


   public function edit($id){
        $query=trim($id);

            $empleado=Empleado::find($query);
            $expacad  = DB::table('expedienteacademic')->select('idempleado')->where('idempleado','=',$query)->get();
            if ($expacad){
                     $raw = DB::raw("idempleado,CONCAT(primernombre,' ', segundonombre,' ',primerapellido,' ', segundoapellido) as nombrecompleto");
                     $empleado  = Empleado::select($raw)->where('idempleado', '=',$query)->get(); //Obtiene nombre completo
                     $expacad  = DB::table('expedienteacademic')->select('idexpedienteacadem')->where('idempleado','=',$query)->get();//Obtiene el idexpediente

                     $expacd= DB::table('expedienteacademic')->select('idexpedienteacadem','idempleado','fechaaperturaexpacad','nombreinstitucion','anotitulacion','tituloobtenido','tituloestudio','direccioninstitucion','descripcionacademica','postgrados')->get();
                    
                     $expacademico=$expacad[0]->idexpedienteacadem;
                     return view("admin/expedienteacademico.edit",["empleados"=>$empleado,"expedienteacademico"=>ExpedienteAcademico::findOrFail($expacademico),"expacads"=>$expacd]);
            }else{
                Session::flash('edit','Aun no existe Expediente!!!');
                return Redirect::to('admin/expedienteacademico');

            }
    }

   
    public function update(ExpedienteAcademicoRequest $request, $id){

                        $affectedRows = ExpedienteAcademico::where('idexpedienteacadem','=',$id)
                        ->update([
                            'fechaaperturaexpacad' =>$request->get('fechaaperturaexpacad'),
                            'nombreinstitucion' =>$request->get('nombreinstitucion'),
                            'anotitulacion' =>$request->get('anotitulacion'),
                            'tituloobtenido' =>$request->get('tituloobtenido'),
                            'tituloestudio' =>$request->get('maestria'),
                            'direccioninstitucion' =>$request->get('direccioninstitucion'),
                            'descripcionacademica' =>$request->get('descripcionacademica'),
                            'postgrados' =>$request->get('postgrados')
                            ]);
                         Session::flash('update','El Expediente actualizado correctamente!!!');
                         return Redirect::to('admin/expedienteacademico');
                }// END UPDATE
    
    

    public function destroy($id)
    {
        //
    }

 


} //END CONTROLLER
