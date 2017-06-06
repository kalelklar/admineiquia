<?php

namespace sisadmineiquia\Http\Controllers;

use Illuminate\Http\Request;

use sisadmineiquia\Http\Requests;
use sisadmineiquia\Puesto;
use Illuminate\Support\Facades\Redirect;
use sisadmineiquia\Http\Requests\PuestoFormRequest;
use Carbon\Carbon;
use Session;
use DB; 

class PuestoController extends Controller
{
    public function __construct()
    {

    }
 
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $puestos=DB::table('puesto as p')
            ->join('departamento as d','p.iddepartamento','=','d.iddepartamento')
            ->join('perfilpuesto as a','a.idperfilpuesto','=','p.idperfilpuesto')
            ->select('p.idpuesto','p.nombrepuesto','p.descripcionpuesto','p.salariopuesto','d.nombredepartamento as departamento','a.profesion','a.reporta','a.sustituye')
            ->where('nombrepuesto','LIKE','%'.$query.'%')
            ->orderBy('idpuesto','desc')->paginate();
            
            return view('admin.puesto.index',["puestos"=>$puestos,"searchText"=>$query]);
        }
    }
 
    public function create()
    {
        $departamentos=DB::table('departamento as d')
        ->select('d.iddepartamento','d.nombredepartamento')->get();
        $perfil=DB::table('perfilpuesto as a')
        ->select('a.idperfilpuesto','a.profesion')->get();
        
    	return view("admin.puesto.create",["departamentos"=>$departamentos,"perfil"=>$perfil]);
    }

    public function store(PuestoFormRequest $request)
    {
    	$puesto=new Puesto;
        $puesto->iddepartamento=$request->get('iddepartamento');
        $puesto->idperfilpuesto=$request->get('idperfilpuesto');
        $puesto->nombrepuesto=$request->get('nombrepuesto');
        $puesto->descripcionpuesto=$request->get('descripcionpuesto');
        $puesto->salariopuesto=$request->get('salariopuesto');
        $puesto->save();
        Session::flash('store','¡El puesto fue creado correctamente!');
        return Redirect::to('admin/puesto');
    }
        
    public function show($id)
    {
        $detallepuesto=DB::table('puesto as p')
            ->join('departamento as d','p.iddepartamento','=','d.iddepartamento')
            ->join('perfilpuesto as a','p.idperfilpuesto','=','a.idperfilpuesto')
            ->select('p.idpuesto','p.nombrepuesto','p.descripcionpuesto','p.salariopuesto','d.nombredepartamento','d.descripciondeparta','a.profesion','a.reporta','a.sustituto','a.relaciones','a.responsabilidades','a.sustituye')
            ->where('p.idpuesto','=',$id)->get();
        //dd($acuerdos);
    	return view("admin.puesto.show",["puesto"=>$detallepuesto]);
    }
        
    public function edit($id)
    {   

        $departamentos=DB::table('departamento as d')
        ->select('d.iddepartamento','d.nombredepartamento')->get();

         $perfil=DB::table('perfilpuesto as a')
        ->select('a.idperfilpuesto','a.profesion')->get();

    	//return view("admin.puesto.edit",["puesto"=>$puesto,"departamentos"=>$departamentos]);
        return view("admin.puesto.edit",["puesto"=>Puesto::findOrFail($id),"departamentos"=>$departamentos,"perfil"=>$perfil]);

    }
        
    public function update(PuestoFormRequest $request,$id)
    {

    	$affectedRows = Puesto::where('idpuesto','=',$id)
        ->update(['nombrepuesto'=> $request->get('nombrepuesto'),
            'descripcionpuesto'=>$request->get('descripcionpuesto'),
            'iddepartamento' =>$request->get('iddepartamento'),
            'idperfilpuesto' =>$request->get('idperfilpuesto'),
            'salariopuesto'=>$request->get('salariopuesto')]);
        Session::flash('update','¡El puesto se ha actualizado correctamente!');       
        return Redirect::to('admin/puesto');

        //$puesto=Puesto::findOrFail($id);
        //$puesto->iddepartamento=$request->get('iddepartamento');
        //$puesto->nombrepuesto=$request->get('nombrepuesto');
        //$puesto->descripcionpuesto=$request->get('descripcionpuesto');
        //$puesto->salariopuesto=$request->get('salariopuesto');
    	//$puesto->update();
        //return Redirect::to('admin/puesto');
    }   

    public function destroy($id)
    {
    	$query=trim($id);
		$expadmin  = DB::table('expedienteadminist')->select('idpuesto')->where('idpuesto','=',$query)->get();
		if ($expadmin){
			Session::flash('destroy','¡El puesto no se puede eliminar, ya ha sido asignado!');
			return Redirect::to('admin/puesto');
		}else{
			$affectedRows = Puesto::where('idpuesto','=',$id)->delete();
			Session::flash('destroy','¡El puesto fue eliminado correctamente!');
			return Redirect::to('admin/puesto');
		}
    }
}