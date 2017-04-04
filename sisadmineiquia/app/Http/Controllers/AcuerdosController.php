<?php

namespace sisadmineiquia\Http\Controllers;

use Illuminate\Http\Request;
use sisadmineiquia\Http\Requests;
use sisadmineiquia\Empleado;
use sisadmineiquia\Acuerdos;
use sisadmineiquia\ExpedienteAdministrativo;
use Illuminate\Support\Facades\Redirect;
use sisadmineiquia\Http\Requests\AcuerdosFormRequest;
use DB;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Input;

class AcuerdosController extends Controller
{
    //pruebas
    public function __construct(){

    }

    public function index(Request $request){
    	
    	if ($request)
        {

            $raw = DB::raw("CONCAT(em.primernombre,' ', em.segundonombre,' ',em.primerapellido,' ',em.segundoapellido) as nombrecompleto");
            $query=trim($request->get('searchText'));
            $acuerdos=DB::table('acuerdoadministrat as a')
            ->join('empleado as em','em.idempleado','=','a.idempleado')
            ->select($raw,'a.idacuerdo','a.motivoacuerdo','a.estadoacuerdo','a.fechaacuerdo','a.archivoacuerdo')
            ->where('idacuerdo','LIKE','%'.$query.'%')
            ->orderBy('fechaacuerdo','desc')->paginate();

            return view('admin.acuerdos.index',["acuerdos"=>$acuerdos,"searchText"=>$query]);
            
        }
    }

    public function create(){

        $raw = DB::raw("idempleado,CONCAT(primernombre,' ', segundonombre,' ',primerapellido,' ',segundoapellido) as nombrecompleto");
        $empleado  = Empleado::select($raw)->get();
        return view("admin.acuerdos.create",["empleado"=>$empleado]);

    }

    public function store(AcuerdosFormRequest $request){

    	$acuerdos=new Acuerdos;
        if(Input::hasfile('archivoacuerdo')){
            $file=Input::file('archivoacuerdo');
            $file->move(public_path().'/acuerdos',Carbon::now()->second.$file->getClientOriginalName());
            $acuerdos->archivoacuerdo=Carbon::now()->second.$file->getClientOriginalName();
        }
        $idacuerdo=$request->get('idacuerdo');
        $acuerdos->idacuerdo=strtoupper($idacuerdo);
		$acuerdos->idempleado=$request->get('idempleado');
		$acuerdos->motivoacuerdo=$request->get('motivoacuerdo');
		$acuerdos->descripcionacuerdo=$request->get('descripcionacuerdo');
        $acuerdos->estadoacuerdo='1';
    	$acuerdos->fechaacuerdo=$request->get('fechaacuerdo');
    	$acuerdos->save();
    	Session::flash('store','Acuerdo Administrativo creado correctamente!!!');
    	return Redirect::to('admin/acuerdos');

    }

    public function edit($id){

        $empleados  = DB::table('acuerdoadministrat')->Select( DB::raw("empleado.idempleado,CONCAT(empleado.primernombre,' ', empleado.segundonombre,' ',empleado.primerapellido,' ', empleado.segundoapellido) as nombrecompleto"))
            ->join('empleado','empleado.idempleado','=','acuerdoadministrat.idempleado')
            ->where('acuerdoadministrat.idacuerdo','=',$id)->get();

    	return view("admin.acuerdos.edit",["acuerdos"=>Acuerdos::findOrFail($id),"empleados"=>$empleados]);

    }

    public function update(AcuerdosFormRequest $request, $id){

        if(Input::hasfile('archivoacuerdo')){

            $file=Input::file('archivoacuerdo');
            $acuerdos=Acuerdos::findOrFail($id);
            $fotovieja=$acuerdos->ARCHIVOACUERDO;

            if (is_file(public_path().'/acuerdos'.$fotovieja)) {
                unlink(public_path().'/acuerdos'.$fotovieja);
            } 

            $file->move(public_path().'/acuerdos',Carbon::now()->second.$file->getClientOriginalName());
    	    $affectedRows = Acuerdos::where('idacuerdo','=',$id)
            ->update(['motivoacuerdo' => $request->get('motivoacuerdo'),'descripcionacuerdo' =>$request->get('descripcionacuerdo'),'estadoacuerdo' =>$request->get('estadoacuerdo'),'fechaacuerdo' =>$request->get('fechaacuerdo'),'archivoacuerdo'=>Carbon::now()->second.$file->getClientOriginalName()]);
    	    Session::flash('update','Acuerdo Administrativo actualizado correctamente!!!');

            return Redirect::to('admin/acuerdos');
        }else{

            $affectedRows = Acuerdos::where('idacuerdo','=',$id)
            ->update(['motivoacuerdo' => $request->get('motivoacuerdo'),'descripcionacuerdo' =>$request->get('descripcionacuerdo'),'estadoacuerdo' =>$request->get('estadoacuerdo'),'fechaacuerdo' =>$request->get('fechaacuerdo')]);
            Session::flash('update','Acuerdo Administrativo actualizado correctamente!!!');

            return Redirect::to('admin/acuerdos');

        }

    }

    public function destroy2($id)
    {
        $acuerdos = Acuerdos::findOrFail($id);

        if($acuerdos -> ESTADOACUERDO == '1')
        {
            $affectedRows = Acuerdos::where('idacuerdo','=',$id)->update(['estadoacuerdo' => 0]);
            return  Redirect::to('admin/acuerdos');
        }else{
            $affectedRows = Acuerdos::where('idacuerdo','=',$id)->update(['estadoacuerdo' => 1]);
            return  Redirect::to('admin/acuerdos');
        }
    }

    public function destroy($id)
    {
        $acuerdos=Acuerdos::where('idacuerdo','=',$id)->delete();
        Session::flash('destroy','Acuerdo Administrativo eliminado correctamente!!!');
        return Redirect::to('admin/acuerdos');
    }

}
