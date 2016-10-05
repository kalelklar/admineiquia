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


class EmpleadoController extends Controller
{
    //
    public function __construct(){

    }

    

    public function index(Request $request){
    	
    	if ($request)
        {
            /*$query=trim($request->get('searchText'));
            $empleados=DB::table('empleado')->where('primernombre','LIKE','%'.$query.'%')
            ->orderBy('estado','desc')->paginate();
            //
            return view('admin.empleado.index',["empleados"=>$empleados,"searchText"=>$query]);*/
            
            // Llamamos al método raw y le pasamos nuestra parte de consulta que queremos realizar.
			$raw = DB::raw("idempleado,CONCAT(primernombre,' ', segundonombre,' ',primerapellido,' ', segundoapellido) as nombrecompleto,dui,nit,estado");
		
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
    	//obtenemos el campo foto definido en el formulario
    	/*$path=$request->get('foto');
    	var_dump($path);*/
    	//obtenemos el nombre de la foto
       	/*$nombre = $path->getClientOriginalName();
    	$name = Carbon::now()->second.$nombre;
		$empleados->foto = $name;
		\Storage::disk('local')->put($name, \File::get($path));*/
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
    	$empleados->estado='1';
    	$empleados->save();
    	Session::flash('store','El Empleado creado correctamente!!!');
    	return Redirect::to('admin/empleado');
    }
    public function show($id){
    	return view("admin.empleado.show",["empleado"=>Empleado::findOrFail($id)]);
    }
    public function edit($id){
    	return view("admin.empleado.edit",["empleado"=>Empleado::findOrFail($id)]);
    }
    public function update(EmpleadoFormRequest $request, $id){

    	$affectedRows = Empleado::where('idempleado','=',$id)->update(['primernombre' => $request->get('primernombre'),'segundonombre' =>$request->get('segundonombre'),'primerapellido' =>$request->get('primerapellido'),'segundoapellido' =>$request->get('segundoapellido'),'dui' =>$request->get('dui'),'nit' => $request->get('nit'),'isss' => $request->get('isss'),'afp' => $request->get('afp')]);
    	Session::flash('update','El Empleado actualizado correctamente!!!');
    	return Redirect::to('admin/empleado');
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
