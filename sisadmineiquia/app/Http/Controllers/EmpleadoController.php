<?php

namespace sisadmineiquia\Http\Controllers;

use Illuminate\Http\Request;

use sisadmineiquia\Http\Requests;

use sisadmineiquia\Empleado;

use sisadmineiquia\ExpedienteAdministrativo;

use sisadmineiquia\Puesto;

use Illuminate\Support\Facades\Redirect;

use sisadmineiquia\Http\Requests\EmpleadoFormRequest;

use DB;

use Carbon\Carbon;

use Session;

use Illuminate\Support\Facades\Input;

use PDF;

use Illuminate\Http\Response;

class EmpleadoController extends Controller
{
    //
    public function __construct(){

    }
 

    public function index(Request $request){
    	
    	if ($request)
        {
            
             // Llamamos al método raw y le pasamos nuestra parte de consulta que queremos realizar.
			$raw = DB::raw("idempleado,CONCAT(primernombre,' ', segundonombre,' ',primerapellido,' ', segundoapellido) as nombrecompleto,dui,nit,estado,foto");
		
			// Llamamos a Persona, utilizamos el método select y le pasamos el $raw almacenado en la linea superior.
			$empleados = Empleado::select($raw)->get();
			return view('admin.empleado.index',["empleados"=>$empleados]);
        }
    }

    public function create(){
    	return view("admin.empleado.create");
    }

    public function store(EmpleadoFormRequest $request){
    	
    	$empleados=new Empleado;

        if(Input::hasfile('foto')){
            $file=Input::file('foto');
            $file->move(public_path().'/fotos/empleados',Carbon::now()->second.$file->getClientOriginalName());
            $empleados->foto=Carbon::now()->second.$file->getClientOriginalName();
        }

		$pnombre=$request->get('primernombre');
		$snombre=$request->get('segundonombre');
		$papellido=$request->get('primerapellido');
		$sapellido=$request->get('segundoapellido');
		$empleados->primernombre=ucfirst($pnombre);
    	$empleados->segundonombre=ucfirst($snombre);
    	$empleados->primerapellido=ucfirst($papellido);
    	$empleados->segundoapellido=ucfirst($sapellido);
    	$empleados->dui=$request->get('dui');
    	$empleados->nit=$request->get('nit');
    	$empleados->isss=$request->get('isss');
    	$empleados->afp=$request->get('afp');
        $empleados->sexo=$request->get('sexo');
    	$empleados->estado='1';
    	$empleados->save();
    	Session::flash('store','El Empleado creado correctamente!!!');
    	return Redirect::to('admin/empleado');
    }
   
    public function show($id){
        $empleado = DB::table('empleado')->select(DB::raw("idempleado,CONCAT(primernombre,' ', segundonombre,' ',primerapellido,' ', segundoapellido) as nombrecompleto,dui,nit,estado,foto,isss,afp,sexo"))->where('idempleado', '=', $id)->get();


            $expadmin=DB::table('expedienteadminist')
        ->select( 
            DB::raw("expedienteadminist.idexpediente,expedienteadminist.fechaapertura,expedienteadminist.codigocontrato,expedienteadminist.modalidadcontratacion,expedienteadminist.idpuesto,expedienteadminist.tiempointegral,expedienteadminist.descripcionadmin,empleado.idempleado,CONCAT(empleado.primernombre,' ', empleado.segundonombre,' ',empleado.primerapellido,' ', empleado.segundoapellido) as nombrecompleto,empleado.dui,empleado.nit,empleado.isss,empleado.afp,empleado.estado,empleado.foto,empleado.sexo,puesto.idpuesto,puesto.nombrepuesto,puesto.salariopuesto,departamento.iddepartamento,departamento.nombredepartamento,departamento.descripciondeparta"))
        ->join('empleado', 'expedienteadminist.idempleado', '=', 'empleado.idempleado')
        ->join('puesto', 'expedienteadminist.idpuesto', '=', 'puesto.idpuesto')
        ->join('departamento', 'puesto.iddepartamento', '=', 'departamento.iddepartamento')
        ->where('expedienteadminist.idempleado', '=', $id)->get();

            if(count($expadmin)!=0){
            $idexp=$expadmin[0]->idexpediente;
            }
            else{
            $idexp=[null];
            }
            


 /******/
        $queryacuerdos = DB::raw("idacuerdo,motivoacuerdo,estadoacuerdo,fechaacuerdo,archivoacuerdo");
        $acuerdos=DB::table('acuerdoadministrat')->select($queryacuerdos)
        ->where('idexpediente', '=',$idexp)->get();
        $queryacuerdos = DB::raw("idacuerdo,motivoacuerdo,estadoacuerdo,fechaacuerdo,archivoacuerdo");
        $acuerdos=DB::table('acuerdoadministrat')->select($queryacuerdos)
        ->where('idexpediente', '=',$idexp)->get();
        $querytiempoadicional = DB::raw("idtiempo,idexpediente,idciclo,fechainicio,fechafin,descripcion,ano");
        $tiempoadicional=DB::table('tiempoadicional')->select($querytiempoadicional)
        ->where('idexpediente', '=',$idexp)->orderBy('ano', 'desc')->orderBy('idciclo', 'desc')->get();
        /******/
    	return view("admin.empleado.show",["empleado"=>$empleado,"expedienteadministrativo"=>$expadmin,"acuerdos"=>$acuerdos,"tiempo"=>$tiempoadicional]);
    }

    public function perfilreport($id){
        
            // Llamamos a Persona, utilizamos el método select y le pasamos el $raw almacenado en la linea superior.
            $empleado = DB::table('empleado')->select(DB::raw("idempleado,CONCAT(primernombre,' ', segundonombre,' ',primerapellido,' ', segundoapellido) as nombrecompleto,dui,nit,estado,foto,isss,afp,sexo"))->where('idempleado', '=', $id)->get();


            $expadmin=DB::table('expedienteadminist')
        ->select( 
            DB::raw("expedienteadminist.idexpediente,expedienteadminist.fechaapertura,expedienteadminist.codigocontrato,expedienteadminist.modalidadcontratacion,expedienteadminist.idpuesto,expedienteadminist.tiempointegral,expedienteadminist.descripcionadmin,empleado.idempleado,CONCAT(empleado.primernombre,' ', empleado.segundonombre,' ',empleado.primerapellido,' ', empleado.segundoapellido) as nombrecompleto,empleado.dui,empleado.nit,empleado.isss,empleado.afp,empleado.estado,empleado.foto,empleado.sexo,puesto.idpuesto,puesto.nombrepuesto,puesto.salariopuesto,departamento.iddepartamento,departamento.nombredepartamento,departamento.descripciondeparta"))
        ->join('empleado', 'expedienteadminist.idempleado', '=', 'empleado.idempleado')
        ->join('puesto', 'expedienteadminist.idpuesto', '=', 'puesto.idpuesto')
        ->join('departamento', 'puesto.iddepartamento', '=', 'departamento.iddepartamento')
        ->where('expedienteadminist.idempleado', '=', $id)->get();

            if(count($expadmin)!=0){
            $idexp=$expadmin[0]->idexpediente;
            }
            else{
            $idexp=[null];
            }
            


 /******/
        $queryacuerdos = DB::raw("idacuerdo,motivoacuerdo,estadoacuerdo,fechaacuerdo,archivoacuerdo");
        $acuerdos=DB::table('acuerdoadministrat')->select($queryacuerdos)
        ->where('idempleado', '=',$id)->get();
        /*$queryacuerdos = DB::raw("idacuerdo,motivoacuerdo,estadoacuerdo,fechaacuerdo,archivoacuerdo");
        $acuerdos=DB::table('acuerdoadministrat')->select($queryacuerdos)
        ->where('idexpediente', '=',$idexp)->get();*/
        $querytiempoadicional = DB::raw("idtiempo,idexpediente,idciclo,fechainicio,fechafin,descripcion,ano");
        $tiempoadicional=DB::table('tiempoadicional')->select($querytiempoadicional)
        ->where('idexpediente', '=',$idexp)->orderBy('ano', 'desc')->orderBy('idciclo', 'desc')->get();
        /******/

        $pdf = PDF::loadView('admin.empleado.show',["empleado"=>$empleado,"expedienteadministrativo"=>$expadmin,"acuerdos"=>$acuerdos,"tiempo"=>$tiempoadicional]);
        //215.9 × 279.4
        $papel_tamaño = array(0,0,216,279);
        $pdf->setPaper("letter" ,'portrait');
        return $pdf->stream('show.pdf');

    }

    public function nominareport(){
        $empleados = DB::table('empleado')->select(DB::raw("idempleado,CONCAT(primernombre,' ', segundonombre,' ',primerapellido,' ', segundoapellido) as nombrecompleto,dui,nit,estado,foto"))->where('estado', '=', '1')->get();

        $pdf = PDF::loadView('admin.empleado.nomina',["empleados"=>$empleados]);
        $papel_tamaño = array(0,0,216,279);
        $pdf->setPaper("letter" ,'portrait');
        //dd($pdf);
        return $pdf->stream('nomina.pdf');

    }

    public function nominareportdownload(){
        $empleados = DB::table('empleado')->select(DB::raw("idempleado,CONCAT(primernombre,' ', segundonombre,' ',primerapellido,' ', segundoapellido) as nombrecompleto,dui,nit,estado,foto"))->where('estado', '=', '1')->get();

        $pdf = PDF::loadView('admin.empleado.nomina',["empleados"=>$empleados]);
        $papel_tamaño = array(0,0,216,279);
        $pdf->setPaper("letter" ,'portrait');
        return $pdf->download('nomina.pdf');

    }

    public function perfilreportdownload($id){
        //dd($id);
        
    }

    public function edit($id){
    	return view("admin.empleado.edit",["empleado"=>Empleado::findOrFail($id)]);
    }
   
    public function update(EmpleadoFormRequest $request, $id){
        //dd($request->get('foto'));
        //dd(Input::hasfile('foto'));
        $pnombre=$request->get('primernombre');
        $snombre=$request->get('segundonombre');
        $papellido=$request->get('primerapellido');
        $sapellido=$request->get('segundoapellido');
        if(Input::hasfile('foto')){
            $file=Input::file('foto');
            //dd($file->getClientOriginalName());
            $empleado=Empleado::findOrFail($id);
            $fotovieja=$empleado->FOTO;
            if (is_file(public_path().'/fotos/empleados/'.$fotovieja)) {
            unlink(public_path().'/fotos/empleados/'.$fotovieja);
            } 
            $file->move(public_path().'/fotos/empleados',Carbon::now()->second.$file->getClientOriginalName());
            $affectedRows = Empleado::where('idempleado','=',$id)->update(['primernombre' => ucfirst($pnombre),'segundonombre' =>ucfirst($snombre),'primerapellido' =>ucfirst($papellido),'segundoapellido' =>ucfirst($sapellido),'dui' =>$request->get('dui'),'nit' => $request->get('nit'),'isss' => $request->get('isss'),'afp' => $request->get('afp'),'foto'=>Carbon::now()->second.$file->getClientOriginalName()]);
                Session::flash('update','El Empleado actualizado correctamente!!!');
                return Redirect::to('admin/empleado');
        }else{
            $affectedRows = Empleado::where('idempleado','=',$id)->update(['primernombre' => ucfirst($pnombre),'segundonombre' =>ucfirst($snombre),'primerapellido' =>ucfirst($papellido),'segundoapellido' =>ucfirst($sapellido),'dui' =>$request->get('dui'),'nit' => $request->get('nit'),'isss' => $request->get('isss'),'afp' => $request->get('afp')]);
                Session::flash('update','El Empleado actualizado correctamente!!!');
                return Redirect::to('admin/empleado');
        }
    }
   
    public function destroy($id){
    	$empleado=Empleado::findOrFail($id);
    	//var_dump($empleado);
    	if($empleado->ESTADO=='1')
    	{
    		$affectedRows = Empleado::where('idempleado','=',$id)->update(['estado' => 0]);
    		return  Redirect::to('admin/empleado');
    	}else{
    		$affectedRows = Empleado::where('idempleado','=',$id)->update(['estado' => 1]);
    		return  Redirect::to('admin/empleado');
    	}
    }

}


 /*static $PAPER_SIZES = array("4a0" => array(0,0,4767.87,6740.79),
                              "2a0" => array(0,0,3370.39,4767.87),
                              "a0" => array(0,0,2383.94,3370.39),
                              "a1" => array(0,0,1683.78,2383.94),
                              "a2" => array(0,0,1190.55,1683.78),
                              "a3" => array(0,0,841.89,1190.55),
                              "a4" => array(0,0,595.28,841.89),
                              "a5" => array(0,0,419.53,595.28),
                              "a6" => array(0,0,297.64,419.53),
                              "a7" => array(0,0,209.76,297.64),
                              "a8" => array(0,0,147.40,209.76),
                              "a9" => array(0,0,104.88,147.40),
                              "a10" => array(0,0,73.70,104.88),
                              "b0" => array(0,0,2834.65,4008.19),
                              "b1" => array(0,0,2004.09,2834.65),
                              "b2" => array(0,0,1417.32,2004.09),
                              "b3" => array(0,0,1000.63,1417.32),
                              "b4" => array(0,0,708.66,1000.63),
                              "b5" => array(0,0,498.90,708.66),
                              "b6" => array(0,0,354.33,498.90),
                              "b7" => array(0,0,249.45,354.33),
                              "b8" => array(0,0,175.75,249.45),
                              "b9" => array(0,0,124.72,175.75),
                              "b10" => array(0,0,87.87,124.72),
                              "c0" => array(0,0,2599.37,3676.54),
                              "c1" => array(0,0,1836.85,2599.37),
                              "c2" => array(0,0,1298.27,1836.85),
                              "c3" => array(0,0,918.43,1298.27),
                              "c4" => array(0,0,649.13,918.43),
                              "c5" => array(0,0,459.21,649.13),
                              "c6" => array(0,0,323.15,459.21),
                              "c7" => array(0,0,229.61,323.15),
                              "c8" => array(0,0,161.57,229.61),
                              "c9" => array(0,0,113.39,161.57),
                              "c10" => array(0,0,79.37,113.39),
                              "ra0" => array(0,0,2437.80,3458.27),
                              "ra1" => array(0,0,1729.13,2437.80),
                              "ra2" => array(0,0,1218.90,1729.13),
                              "ra3" => array(0,0,864.57,1218.90),
                              "ra4" => array(0,0,609.45,864.57),
                              "sra0" => array(0,0,2551.18,3628.35),
                              "sra1" => array(0,0,1814.17,2551.18),
                              "sra2" => array(0,0,1275.59,1814.17),
                              "sra3" => array(0,0,907.09,1275.59),
                              "sra4" => array(0,0,637.80,907.09),
                              "letter" => array(0,0,612.00,792.00),
                              "legal" => array(0,0,612.00,1008.00),
                              "ledger" => array(0,0,1224.00, 792.00),
                              "tabloid" => array(0,0,792.00, 1224.00),
                              "executive" => array(0,0,521.86,756.00),
                              "folio" => array(0,0,612.00,936.00),
                              "commerical #10 envelope" => array(0,0,684.00,297.00),
                              "catalog #10 1/2 envelope" => array(0,0,648.00,864.00),
                              "8.5x11" => array(0,0,612.00,792.00),
                              "8.5x14" => array(0,0,612.00,1008.0),
                              "11x17"  => array(0,0,792.00, 1224.00));*/