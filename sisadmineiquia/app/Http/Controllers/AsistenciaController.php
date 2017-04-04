<?php

namespace sisadmineiquia\Http\Controllers;

use Illuminate\Http\Request;
use sisadmineiquia\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use sisadmineiquia\Http\Requests\AsistenciaFormRequest;
use sisadmineiquia\Asistencia;
use sisadmineiquia\DetalleAsistencia;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Response;
use Session;
use DB;

class AsistenciaController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        if ($request)
        {
            $asistencias=DB::table('asistencia')
            ->select('idasistencia','fechaasistencia','turno')
            ->orderBy('idasistencia','asc')
            ->get();

            return view('admin.asistencia.index',["asistencias"=>$asistencias]);
        }
    }

    public function create()
    {
        $empleados=DB::table('expedienteadminist as exp')
            ->join('empleado as emp','emp.idempleado','=','exp.idempleado')
            ->select('exp.idexpediente','exp.idempleado',DB::raw("CONCAT(emp.primernombre,' ', emp.segundonombre,' ',emp.primerapellido,' ', emp.segundoapellido) as nombre"))->get();

              $asistencias=DB::table('asistencia')
            ->select('idasistencia')
            ->get();

    	return view("admin.asistencia.create",["empleados"=>$empleados,"asistencias"=>$asistencias]);
    }

    public function store(AsistenciaFormRequest $request)
    {
        try{
            DB::beginTransaction();

            $fecha=$request->get('fechaasistencia');
            
            $asistencias=DB::table('asistencia')
            ->select('turno')
            ->where('fechaasistencia','=',$fecha)
            ->get();

                foreach ($asistencias as $asis)
                {  
                    if($asis->turno==0){
                        Session::flash('store','¡El turno "Mañana" ya esta registrado para esta fecha: '.$fecha);
                    }

                    if($asis->turno==1)                
                        Session::flash('store','¡El turno "Tarde" ya esta registrado para esta fecha: '.$fecha);
                
                return Redirect::to('admin/asistencia/create');                                  
                }

    		$asistencia=new Asistencia;
            $asistencia->idasistencia=$request->get('idasistencia');
        	$asistencia->fechaasistencia=$request->get('fechaasistencia');
        	$asistencia->turno=$request->get('turno');
        	$asistencia->save();

            $idexpediente=$request->get('idexpediente');
            $f=$horaentrada=$request->get('horaentrada');
            $horasalida=$request->get('horasalida');
            $observaciones=$request->get('observaciones');

            $cont=0;

            while($cont <count($idexpediente)){

                $detalle=new DetalleAsistencia;
                $detalle->idasistencia=$asistencia->idasistencia;
                $detalle->idexpediente=$idexpediente[$cont];
                $detalle->horaentrada=$horaentrada[$cont];
                $detalle->horasalida=$horasalida[$cont];
                $detalle->observaciones=$observaciones[$cont];
                $detalle->save();
                $cont=$cont+1;             
            }   

            DB::commit();

        }catch(\Exception $e)
        {
            DB::rollback();
        }
 
        Session::flash('store','¡La asitencia se ha almacenado correctamente!');
        return Redirect::to('admin/asistencia');
    }

    public function show($id)
    {   
    	$asistencia=DB::table('asistencia')
    		->select('idasistencia','fechaasistencia','turno')
            ->where('idasistencia','=',$id)
            ->get();

        $detalles=DB::table('detalleasistencia as det')
        	->join('expedienteadminist as exp','exp.idexpediente','=','det.idexpediente')
            ->join('empleado as emp','emp.idempleado','=','exp.idempleado')
            ->select('exp.idexpediente','exp.idempleado','det.iddetalleasistencia as iddetalle','det.horaentrada','det.horasalida','det.observaciones',
              DB::raw("CONCAT(emp.primernombre,' ', emp.segundonombre,' ',emp.primerapellido,' ', emp.segundoapellido) as nombre"))
            ->where('det.idasistencia','=',$id)
            ->orderBy('iddetalle','asc')
            ->get();
            
    	return view("admin.asistencia.show",["asistencia"=>$asistencia,"detalles"=>$detalles]);
    }

    public function edit($id)
    {   
        $empleados=DB::table('expedienteadminist as exp')
            ->join('empleado as emp','emp.idempleado','=','exp.idempleado')
            ->select('exp.idexpediente','exp.idempleado',DB::raw("CONCAT(emp.primernombre,' ', emp.segundonombre,' ',emp.primerapellido,' ', emp.segundoapellido) as nombre"))->get();

        $asistencia=DB::table('asistencia')
            ->select('idasistencia','fechaasistencia','turno')
            ->where('idasistencia','=',$id)
            ->get();

        $detalles=DB::table('detalleasistencia as det')
            ->join('expedienteadminist as exp','exp.idexpediente','=','det.idexpediente')
            ->join('empleado as emp','emp.idempleado','=','exp.idempleado')
            ->select('exp.idexpediente','exp.idempleado','det.iddetalleasistencia as iddetalle','det.horaentrada','det.horasalida','det.observaciones',
              DB::raw("CONCAT(emp.primernombre,' ', emp.segundonombre,' ',emp.primerapellido,' ', emp.segundoapellido) as nombre"))
            ->where('det.idasistencia','=',$id)
            ->get();
            
        return view("admin.asistencia.edit",["asistencia"=>$asistencia,"detalles"=>$detalles,"empleados"=>$empleados]);
    }

    public function update(AsistenciaFormRequest $request,$id)
    {    
        $asistencia=Asistencia::findOrFail($id);
        $asistencia->fechaasistencia=$request->get('fechaasistencia');
        $asistencia->turno=$request->get('turno');
        $asistencia->update();

        $asistencia->idasistencia=$request->get('idasistencia');
        $f=$iddetalle=$request->get('iddetalle');
        $idexpediente=$request->get('idexpediente');

        //$idempleado=$request->get('idempleado');
        $horaentrada=$request->get('horaentrada');
        $horasalida=$request->get('horasalida');
        $observaciones=$request->get('observaciones');
        $eliminar=$request->get('eliminardetalle');
       
        $cont=0;

        while($cont <count($iddetalle))
        { 
            if ($iddetalle[$cont]=="") {
                
                $detalle=new DetalleAsistencia;
                $detalle->idasistencia=$asistencia->idasistencia;
                $detalle->idexpediente=$idexpediente[$cont];
                $detalle->horaentrada=$horaentrada[$cont];
                $detalle->horasalida=$horasalida[$cont];
                $detalle->observaciones=$observaciones[$cont];
                $detalle->save();
                $cont=$cont+1;    

            }
            else{
            	$affectedRows = DetalleAsistencia::where('iddetalleasistencia','=',$iddetalle[$cont])
            	->update(['idexpediente'=>$idexpediente[$cont],
            	'idasistencia'=> $asistencia->idasistencia,
            	'horaentrada' =>$horaentrada[$cont],
            	'horasalida'=>$horasalida[$cont],
            	'observaciones'=>$observaciones[$cont]]);
            	$cont=$cont+1;
            	echo $cont;
            }
        }

         $numdet=0;
    
        while($numdet <count($eliminar))
        {
            if ($eliminar[$numdet]==1){
                echo $numdet;
                $affectedRows = DetalleAsistencia::where('iddetalleasistencia','=',$iddetalle[$numdet])->delete();
            }
            $numdet=$numdet+1;
        }

        Session::flash('update','¡El detalle de asitencia se ha actualizado!');       
        return Redirect::to('admin/asistencia'); 
    }

    public function destroy($id)
    {
        $affectedRows = DetalleAsistencia::where('idasistencia','=',$id)->delete();
        $affectedRows = Asistencia::where('idasistencia','=',$id)->delete();

        Session::flash('destroy','¡El registro fue eliminado correctamente!');
        return Redirect::to('admin/asistencia');
        
    }

    public function removedetail($id)
    {
        $affectedRows = DetalleAsistencia::where('iddetalleasistencia','=',$id)->delete();
        
        Session::flash('destroy','¡El registro fue eliminado correctamente!');
        //return Redirect::to('admin/asistencia');
        
    }


    public function reporte($mes) 
    {  
         $year=Carbon::now()->year;
         $date=$mes.'-'.$year;
       
         $detalles=DB::table('detalleasistencia as det')
            ->join('expedienteadminist as exp','exp.idexpediente','=','det.idexpediente')
            ->join('empleado as emp','emp.idempleado','=','exp.idempleado')
            ->join('asistencia as asis','asis.idasistencia','=','det.idasistencia')
            ->select('asis.fechaasistencia','asis.turno','exp.idexpediente','exp.idempleado','det.iddetalleasistencia as iddetalle','det.horaentrada','det.horasalida','det.observaciones',
              DB::raw("CONCAT(emp.primernombre,' ', emp.segundonombre,' ',emp.primerapellido,' ', emp.segundoapellido) as nombre"))
            ->where('asis.fechaasistencia','LIKE','%'.$date.'%')
            ->orderBy('iddetalle','asc')
            ->get();
        
       
        $date = $mes.'-'.$year;

        Excel::create('Registro de Asistencia '.$date, function($excel) use($detalles) 
        {
            $excel->sheet('Asistencia', function($sheet) use($detalles)
            {
        
                $data=[];
 
                array_push($data, array('Fecha','Turno','Expediente','Nombre Empleado','Hora de Entrada','Hora de Salida','Observaciones'));


                foreach ($detalles as $det ) 
                {
                    if($det->turno==0){
                        $det->turno="Mañana";
                    }
                    else{
                         $det->turno="Tarde";
                    }

                    $t=$det->horaentrada;
                    $h=$t[0].$t[1];
                    $m=$t[3].$t[4];

                    $time = Carbon::now();
                    $time->setTime($h,$m)->toDateTimeString();
                    $time = $time->format('h:i A');
                    $det->horaentrada=$time;

                    $t=$det->horasalida;
                    $h=$t[0].$t[1];
                    $m=$t[3].$t[4];

                    $time = Carbon::now();
                    $time->setTime($h,$m)->toDateTimeString();
                    $time = $time->format('h:i A');
                    $det->horasalida=$time;

                    array_push($data, array($det->fechaasistencia, $det->turno, $det->idexpediente, $det->nombre, $det->horaentrada, $det->horasalida, $det->observaciones));
                }
 
                $sheet->fromArray($data, null, 'A2', false, false);
            });


            $excel->sheet('Permisos', function($sheet) 
            {   
                $expedientes=DB::table('expedienteadminist as exp')
                ->join('permiso as p','p.idexpediente','=','exp.idexpediente')
                ->distinct()
                ->select('exp.idexpediente')
                ->get();
        
                $data=[];
 
                array_push($data, array('Expediente','Nombre Empleado','Cantidad total de permisos','Tiempo total otorgado'));


                foreach ($expedientes as $exp) 
                {

                    $permisos=DB::table('permiso as p')
                    ->join('expedienteadminist as exp','exp.idexpediente','=','p.idexpediente')
                    ->join('empleado as emp','emp.idempleado','=','exp.idempleado')
                    ->where('p.idexpediente','=',$exp->idexpediente)
                    ->select('exp.idexpediente','p.idpermiso','p.tiemposolicitadohora','p.tiemposolicitadomin',
                    DB::raw("CONCAT(emp.primernombre,' ', emp.segundonombre,' ',emp.primerapellido,' ', emp.segundoapellido) as nombre"),
                    DB::raw('count(*) as permiso_count'),
                    DB::raw('sum(p.tiemposolicitadohora) as horas_count'),
                    DB::raw('sum(p.tiemposolicitadomin) as min_count'))
                    ->get();

                    foreach ($permisos as $per)
                    {
                        $cant_permiso=$per->permiso_count;
                        $horas=$per->horas_count;
                        $min=$per->min_count;
                
                        $h=intdiv($min,60);
                
                        if($h>0){

                            $horas=$horas+$h;
                            $min=($min-($h*60));
                        }

                        array_push($data, array($per->idexpediente, $per->nombre, $cant_permiso, $horas.' horas con '.$min.' minutos'));
                    }
                }
 
                 $sheet->fromArray($data, null, 'A2', false, false);
            });


        })->download('xlsx');

       return Redirect::to('admin/asistencia');
    }

}
