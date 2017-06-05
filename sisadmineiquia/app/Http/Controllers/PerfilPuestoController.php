<?php

namespace sisadmineiquia\Http\Controllers;

use Illuminate\Http\Request;

use sisadmineiquia\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use sisadmineiquia\Http\Requests\PerfilPuestoRequest;
use sisadmineiquia\PerfilPuesto;
use Carbon\Carbon;
use Session;
use DB; 

class PerfilPuestoController extends Controller
{
   public function __construct()
    {

    } 

    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $perfil=DB::table('perfilpuesto as p')
            ->select('p.idperfilpuesto','p.profesion','p.reporta','p.sustituto','p.relaciones','p.responsabilidades','p.sustituye')
            ->where('profesion','LIKE','%'.$query.'%')
            ->orderBy('idperfilpuesto','desc')->paginate();
            
            return view('admin.perfilpuesto.index',["perfil"=>$perfil,"searchText"=>$query]);
        }
    }
 
    public function create()
    {
       	return view("admin.perfilpuesto.create");
    }

    public function store(PerfilPuestoRequest $request)
    {
    	$perfil=new PerfilPuesto;
        $perfil->profesion=$request->get('profesion');
        $perfil->reporta=$request->get('reporta');
        $perfil->sustituto=$request->get('sustituto');
        $perfil->relaciones=$request->get('relaciones');
        $perfil->responsabilidades=$request->get('responsabilidades');
        $perfil->sustituye=$request->get('sustituye');
        $perfil->save();
        Session::flash('store','¡El perfil del puesto fue creado correctamente!');
        return Redirect::to('admin/perfilpuesto');
    }
        
    public function show($id)
    {
    	return view("admin.perfilpuesto.show",["perfil"=>PerfilPuesto::findOrFail($id)]);
    }
        
    public function edit($id)
    {   
        
        return view("admin.perfilpuesto.edit",["perfil"=>PerfilPuesto::findOrFail($id)]);

    }
        
    public function update(PerfilPuestoRequest $request,$id)
    {

    	$affectedRows = PerfilPuesto::where('idperfilpuesto','=',$id)
        ->update(['profesion'=> $request->get('profesion'),
            'reporta'=>$request->get('reporta'),
            'sustituto' =>$request->get('sustituto'),
            'relaciones' =>$request->get('relaciones'),
            'responsabilidades' =>$request->get('responsabilidades'),
            'sustituye' =>$request->get('sustituye')]);
        Session::flash('update','¡El perfil del puesto se ha actualizado correctamente!');       
        return Redirect::to('admin/perfilpuesto');
    }   

    public function destroy($id)
    {
    	$query=trim($id);
		$puesto = DB::table('puesto')->select('idperfilpuesto')->where('idperfilpuesto','=',$query)->get();
		if ($puesto){
			Session::flash('destroy','¡El perfil no puede ser eliminado, ya ha sido asignado!');
			return Redirect::to('admin/perfilpuesto');
		}else{
			$affectedRows = PerfilPuesto::where('idperfilpuesto','=',$id)->delete();
			Session::flash('destroy','¡El perfil del puesto se ha eliminado correctamente!');
			return Redirect::to('admin/perfilpuesto');
		}
    }
}
