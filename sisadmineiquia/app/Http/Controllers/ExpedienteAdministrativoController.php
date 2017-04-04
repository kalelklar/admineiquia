<?php

namespace sisadmineiquia\Http\Controllers;

use Illuminate\Http\Request;

use sisadmineiquia\Http\Requests;

use sisadmineiquia\Empleado;

use sisadmineiquia\ExpedienteAdministrativo;

use sisadmineiquia\Acuerdos;

use sisadmineiquia\Puesto;

use sisadmineiquia\Tiempo;

use Illuminate\Support\Facades\Redirect;

use sisadmineiquia\Http\Requests\ExpedienteAdministrativoFormRequest;

use DB;

use Carbon\Carbon;

use Session;


class ExpedienteAdministrativoController extends Controller
{
    //
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
                       //
            $expedienteadmin=DB::table('expedienteadminist')->select( DB::raw("expedienteadminist.idexpediente,expedienteadminist.fechaapertura,expedienteadminist.modalidadcontratacion,expedienteadminist.idpuesto,expedienteadminist.tiempointegral,empleado.idempleado,CONCAT(empleado.primernombre,' ', empleado.segundonombre,' ',empleado.primerapellido,' ', empleado.segundoapellido) as nombrecompleto,empleado.dui,empleado.nit,empleado.estado,empleado.foto,puesto.idpuesto,puesto.nombrepuesto"))->join('empleado', 'expedienteadminist.idempleado', '=', 'empleado.idempleado')->join('puesto', 'expedienteadminist.idpuesto', '=', 'puesto.idpuesto')->get();
            //var_dump($expedienteadmin);
            return view('admin.expedienteadministrativo.index',["expedienteadministrativos"=>$expedienteadmin]);
            
        }
    }

    public function create(){
        //$empleado = Empleado::lists('primernombre','idempleado');
        // Llamamos al método raw y le pasamos nuestra parte de consulta que queremos realizar.
        $raw = DB::raw("idempleado,CONCAT(primernombre,' ', segundonombre,' ',primerapellido,' ', segundoapellido) as nombrecompleto");
        
        // Llamamos a Empleado, utilizamos el método select y le pasamos el $raw almacenado en la linea superior.
        $empleado  = Empleado::select($raw)->get();
        $puesto = DB::table('puesto')->select('idpuesto','nombrepuesto')->get();
        $acuerdo = DB::table('acuerdoadministrat')->select('idacuerdo','motivoacuerdo')->get();
        //return view("admin.expedienteadministrativo.create",["empleados"=>$empleado,"puestos"=>$puesto]);
        
        return view("admin.expedienteadministrativo.create",["empleados"=>$empleado,"puestos"=>$puesto,"acuerdos"=>$acuerdo]);
    }

    public function store(ExpedienteAdministrativoFormRequest $request){
        
        
        if ($request)
        {
            $query=trim($request->get('idempleado'));
            $queryacuerdos=trim($request->get('codigocontrato'));;

            $empleado=Empleado::find($query);
            //var_dump($empleado);
            $expadmin  = DB::table('expedienteadminist')->select('idempleado')->where('idempleado','=',$query)->get();
            $acuerdoemp  = DB::table('acuerdoadministrat')->select('idempleado')->where('idacuerdo','=',$queryacuerdos)->get();
            //dd($acuerdoemp[0]->idempleado);
            if ($expadmin){
                Session::flash('store','El Expediente ya existe!!!');
            }else if($acuerdoemp[0]->idempleado!=$query){
                Session::flash('store','El codigo de contrato no corresponde al empleado  verifiquelo!!!');
            }else{
                    $p1=ucfirst($empleado->PRIMERAPELLIDO);
                    $p2=ucfirst($empleado->SEGUNDOAPELLIDO);
                    $ad="AD";
                    $expedienteadministrativo=new ExpedienteAdministrativo;
                    $expedienteadministrativo->idexpediente=$ad.$p1[0].$p2[0].$request->get('idempleado');
                    $expedienteadministrativo->idempleado=$request->get('idempleado');
                    $expedienteadministrativo->idpuesto=$request->get('idpuesto');
                    $expedienteadministrativo->fechaapertura=$request->get('fechaapertura');
                    if ($request->get('tiempointegral')==null){
                        $expedienteadministrativo->tiempointegral="0";
                    }else{
                        $expedienteadministrativo->tiempointegral=$request->get('tiempointegral');
                    }
                    $expedienteadministrativo->codigocontrato=$request->get('codigocontrato');
                    $expedienteadministrativo->modalidadcontratacion=$request->get('modalidadcontratacion');
                    $expedienteadministrativo->descripcionadmin=$request->get('descripcionadmin');
                    $expedienteadministrativo->save();
                    Session::flash('store','El Expediente creado correctamente!!!');
                    return Redirect::to('admin/expedienteadministrativo');
                }
        }
        return Redirect::to('admin/expedienteadministrativo/create');

    }
    public function show($id){
        $expedienteadmin=DB::table('expedienteadminist')
        ->select( 
            DB::raw("expedienteadminist.idexpediente,expedienteadminist.fechaapertura,expedienteadminist.codigocontrato,expedienteadminist.modalidadcontratacion,expedienteadminist.idpuesto,expedienteadminist.tiempointegral,expedienteadminist.descripcionadmin,empleado.idempleado,CONCAT(empleado.primernombre,' ', empleado.segundonombre,' ',empleado.primerapellido,' ', empleado.segundoapellido) as nombrecompleto,empleado.dui,empleado.nit,empleado.isss,empleado.afp,empleado.estado,empleado.foto,empleado.sexo,puesto.idpuesto,puesto.nombrepuesto,puesto.salariopuesto,departamento.iddepartamento,departamento.nombredepartamento,departamento.descripciondeparta"))
        ->join('empleado', 'expedienteadminist.idempleado', '=', 'empleado.idempleado')
        ->join('puesto', 'expedienteadminist.idpuesto', '=', 'puesto.idpuesto')
        ->join('departamento', 'puesto.iddepartamento', '=', 'departamento.iddepartamento')
        ->where('idexpediente','=',$id)->get();

        $queryacuerdos = DB::raw("acuerdoadministrat.idacuerdo,acuerdoadministrat.idempleado,acuerdoadministrat.motivoacuerdo,acuerdoadministrat.estadoacuerdo,acuerdoadministrat.fechaacuerdo,acuerdoadministrat.archivoacuerdo");
        $acuerdos=DB::table('acuerdoadministrat')->select($queryacuerdos)
        ->join('empleado', 'acuerdoadministrat.idempleado', '=', 'empleado.idempleado')
        ->join('expedienteadminist', 'empleado.idempleado', '=', 'expedienteadminist.idempleado')
        ->where('expedienteadminist.idexpediente', '=',$id)->get();

        $querytiempoadicional = DB::raw("idtiempo,idexpediente,idciclo,fechainicio,fechafin,descripcion,ano");
        $tiempoadicional=DB::table('tiempoadicional')->select($querytiempoadicional)
        ->where('idexpediente', '=',$id)->orderBy('ano', 'desc')->orderBy('idciclo', 'desc')->get();
        //dd($acuerdos);
        return view('admin.expedienteadministrativo.show',["expedienteadministrativos"=>$expedienteadmin,"acuerdos"=>$acuerdos,"tiempo"=>$tiempoadicional]);
    }

    public function edit($id){
        $query=trim($id);

            $empleado=Empleado::find($query);
            //var_dump($empleado);
            $expadmin  = DB::table('expedienteadminist')->select('idempleado')->where('idempleado','=',$query)->get();
            if ($expadmin){
                
                /*$users = DB::table('users')
                     ->select(DB::raw('count(*) as user_count, status'))
                     ->where('status', '<>', 1)
                     ->groupBy('status')
                     ->get();*/
        // Llamamos al método raw y le pasamos nuestra parte de consulta que queremos realizar.
                     $raw = DB::raw("idempleado,CONCAT(primernombre,' ', segundonombre,' ',primerapellido,' ', segundoapellido) as nombrecompleto");
                     // Llamamos a Empleado, utilizamos el método select y le pasamos el $raw almacenado en la linea superior.
                     $empleado  = Empleado::select($raw)->where('idempleado', '=',$query)->get();
                     $expadmin  = DB::table('expedienteadminist')->select('idexpediente')->where('idempleado','=',$query)->get();
                     $expadminid=$expadmin[0]->idexpediente;
                     $puesto = DB::table('puesto')->select('idpuesto','nombrepuesto')->get();
                     return view("admin/expedienteadministrativo.edit",["empleados"=>$empleado,"expedienteadministrativo"=>ExpedienteAdministrativo::findOrFail($expadminid),"puestos"=>$puesto]);
            }else{
                Session::flash('edit','Aun no existe Expediente!!!');
                return Redirect::to('admin/empleado');

            }
    }

    public function update(ExpedienteAdministrativoFormRequest $request, $id){
        //dd($request->get('tiempointegral'));
        //dd($id);

        if ($request->get('tiempointegral')==null){
                        $tiempointegral=0;
                        $affectedRows = ExpedienteAdministrativo::where('idexpediente','=',$id)->update([
                            'fechaapertura' =>$request->get('fechaapertura'),
                            'codigocontrato' =>$request->get('codigocontrato'),
                            'modalidadcontratacion' =>$request->get('modalidadcontratacion'),
                            'idpuesto' =>$request->get('idpuesto'),
                            'tiempointegral' =>$tiempointegral,
                            'descripcionadmin'=>$request->get('descripcionadmin')]);
        Session::flash('update','El Expediente actualizado correctamente!!!');
        return Redirect::to('admin/expedienteadministrativo');
                    }else{
                        $tiempointegral=$request->get('tiempointegral');
                        $affectedRows = ExpedienteAdministrativo::where('idexpediente','=',$id)->update(['fechaapertura' =>$request->get('fechaapertura'),'codigocontrato' =>$request->get('codigocontrato'),'modalidadcontratacion' =>$request->get('modalidadcontratacion'),'tiempointegral' => $tiempointegral,'descripcionadmin'=>$request->get('descripcionadmin')]);
        Session::flash('update','El Expediente actualizado correctamente!!!');
        return Redirect::to('admin/expedienteadministrativo');
                    }
    
    }

}
