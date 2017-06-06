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
             $fechainicio=trim($request->get('fechainicio'));
             $fechafin=trim($request->get('fechafin'));
            
            if ($fechainicio!=null && $fechafin!=null){

                    return $this->reporte($fechainicio,$fechafin);
                }    

            $asistencias=DB::table('asistencia')
            ->select('idasistencia','fechaasistencia','turno')
            ->orderBy('fechaasistencia','asc')
            ->paginate(15);

             foreach ($asistencias as $asis) {
                 $date=new Carbon($asis->fechaasistencia);
                 setlocale(LC_TIME,'Spanish');
                 $asis->fechaasistencia = $date->formatLocalized('%d %B %Y');
             }

            return view('admin.asistencia.index',["asistencias"=>$asistencias]);
        }

    }

    public function create()
    {
        $empleados=DB::table('expedienteadminist as exp')
            ->join('empleado as emp','emp.idempleado','=','exp.idempleado')
            ->select('exp.idexpediente','exp.idempleado',DB::raw("CONCAT(emp.primernombre,' ', emp.segundonombre,' ',emp.primerapellido,' ', emp.segundoapellido) as nombre"))->get();

              $asistencia=DB::table('asistencia')
            ->select('idasistencia')
            ->get();
        $emplea=$empleados;

    	return view("admin.asistencia.create",["empleados"=>$empleados,"asistencia"=>$asistencia]);
    }

    public function store(AsistenciaFormRequest $request)
    {    
         // Verificar turno no sea repetido

        $fecha=$request->get('fechaasistencia'); 
        $date=new Carbon($fecha);
        $fecha = $date->format('Y-m-d');
        
        $asistencias=DB::table('asistencia')
        ->select('turno')
        ->where('fechaasistencia','=',$fecha)
        ->get();

        $turnos=new Asistencia;
        $turnos->turno=$request->get('turno');

            foreach ($asistencias as $asis)
            {  
                if($asis->turno==0 && $asis->turno==$turnos->turno){
                    Session::flash('store','¡El turno "Mañana" ya esta registrado para esta fecha: '.$fecha);
                    return Redirect::to('admin/asistencia/create');
                }

                if($asis->turno==1 && $asis->turno==$turnos->turno){               
                    Session::flash('store','¡El turno "Tarde" ya esta registrado para esta fecha: '.$fecha);
                    return Redirect::to('admin/asistencia/create');
                }                                  
            }

    try{
        DB::beginTransaction();

        //Datos Recibidos 
    	$asistencia=new Asistencia;
        $asistencia->idasistencia=$request->get('idasistencia');
        $asistencia->fechaasistencia=$request->get('fechaasistencia');
        $asistencia->turno=$request->get('turno');
        //detalles
        $idexpediente=$request->get('idexpediente');
        $asistentes=$request->get('asistio');
        $horaentrada=$request->get('horaentrada');
        $horasalida=$request->get('horasalida');
        $observaciones=$request->get('observaciones');
       
        // cambiar formato fecha
        $date=new Carbon($asistencia->fechaasistencia);
        $date = $date->format('Y-m-d');
        $asistencia->fechaasistencia=$date;

        $asistencia->save(); // guardar asistencia

        // Guardar Detalles asistencia
        $cont=0;

        while($cont <count($idexpediente))
        {
            $detalle=new DetalleAsistencia;
                
            if($asistentes[$cont]==1)
            {
                if($horaentrada[$cont]!=null AND $horasalida[$cont]!=null)
                {
                 $detalle->idasistencia=$asistencia->idasistencia;
                 $detalle->idexpediente=$idexpediente[$cont];
                 $detalle->asistio=$asistentes[$cont];
                 $detalle->horaentrada=$horaentrada[$cont];
                 $detalle->horasalida=$horasalida[$cont];
                 $detalle->observaciones=$observaciones[$cont];
                 $detalle->save();
                }
                else{
                    Session::flash('store','¡Verifique, Hora Entrada y Hora Salida no pueden estar vacias para empleados que asistierón');
                    DB::rollback();
                    return back();
                    //return back()->withInput($empleados,$asistencias);
                    //return Redirect::back()->withInput(Input::all());
                    //return redirect()->to($this->getRedirectUrl())->withInput($request->input());
                }
            }

              else{

                  $detalle->idasistencia=$asistencia->idasistencia;
                  $detalle->idexpediente=$idexpediente[$cont];
                  $detalle->asistio=$asistentes[$cont];
                  $detalle->horaentrada="";
                  $detalle->horasalida="";
                  $detalle->observaciones=$observaciones[$cont];
                  $detalle->save();
                }
                 
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

           foreach ($asistencia as $asis) {
                 $date=new Carbon($asis->fechaasistencia);
                 setlocale(LC_TIME,'Spanish');
                 $asis->fechaasistencia = $date->formatLocalized('%d %B %Y');
             }

        $detalles=DB::table('detalleasistencia as det')
        	->join('expedienteadminist as exp','exp.idexpediente','=','det.idexpediente')
            ->join('empleado as emp','emp.idempleado','=','exp.idempleado')
            ->select('exp.idexpediente','exp.idempleado','det.iddetalleasistencia as iddetalle','det.asistio','det.horaentrada','det.horasalida','det.observaciones',
              DB::raw("CONCAT(emp.primernombre,' ', emp.segundonombre,' ',emp.primerapellido,' ', emp.segundoapellido) as nombre"))
            ->where('det.idasistencia','=',$id)
            ->orderBy('iddetalle','asc')
            ->get();
            
    	return view("admin.asistencia.show",["asistencia"=>$asistencia,"detalles"=>$detalles]);
    }

    public function edit($id)
    {   
        /*$empleados=DB::table('expedienteadminist as exp')
            ->join('empleado as emp','emp.idempleado','=','exp.idempleado')
            ->select('exp.idexpediente','exp.idempleado',DB::raw("CONCAT(emp.primernombre,' ', emp.segundonombre,' ',emp.primerapellido,' ', emp.segundoapellido) as nombre"))->get(); */

        $asistencia=DB::table('asistencia')
            ->select('idasistencia','fechaasistencia','turno')
            ->where('idasistencia','=',$id)
            ->get();

        foreach ($asistencia as $asis) {
                 $date=new Carbon($asis->fechaasistencia);
                 setlocale(LC_TIME,'Spanish');
                 $asis->fechaasistencia = $date->formatLocalized('%d %B %Y');
             }

        $detalles=DB::table('detalleasistencia as det')
            ->join('expedienteadminist as exp','exp.idexpediente','=','det.idexpediente')
            ->join('empleado as emp','emp.idempleado','=','exp.idempleado')
            ->select('exp.idexpediente','exp.idempleado','det.iddetalleasistencia as iddetalle','det.asistio','det.horaentrada','det.horasalida','det.observaciones',
              DB::raw("CONCAT(emp.primernombre,' ', emp.segundonombre,' ',emp.primerapellido,' ', emp.segundoapellido) as nombre"))
            ->where('det.idasistencia','=',$id)
            ->get();
            
        return view("admin.asistencia.edit",["asistencia"=>$asistencia,"detalles"=>$detalles]);
    }

    public function update(AsistenciaFormRequest $request,$id)
    {   
        
        // Datos recibidos Asistencia
        $asistencia=new Asistencia;
        $asistencia->idasistencia=$request->get('idasistencia');

        // Datos recibidos Detalles Asistencia
        $iddetalle=$request->get('iddetalle');
        $idexpediente=$request->get('idexpediente');
        $idempleado=$request->get('idempleado');
        $asistentes=$request->get('asistio');
        $horaentrada=$request->get('horaentrada');
        $horasalida=$request->get('horasalida');
        $observaciones=$request->get('observaciones');


       try{
            DB::beginTransaction();
   
        // Actualizar Detalles Asistencia
        $cont=0; 

        while($cont <count($iddetalle))
        { 
            if($asistentes[$cont]==1)
            {   
                if($horaentrada[$cont]!=null AND $horasalida[$cont]!=null)
                {
            	   $affectedRows = DetalleAsistencia::where('iddetalleasistencia','=',$iddetalle[$cont])
            	   ->update(['idexpediente'=>$idexpediente[$cont],
            	   'idasistencia'=> $asistencia->idasistencia,
                    'asistio'=> $asistentes[$cont],
            	   'horaentrada' =>$horaentrada[$cont],
            	   'horasalida'=>$horasalida[$cont],
            	   'observaciones'=>$observaciones[$cont]]);
            	   $cont=$cont+1;
                }
                else{
                     Session::flash('store','¡Verifique, Hora Entrada y Hora Salida no pueden estar vacias para empleados que asistierón');
                     DB::rollback();
                     return back();
                    }   
            }
            else{
                 $vacio=" ";
                 $affectedRows = DetalleAsistencia::where('iddetalleasistencia','=',$iddetalle[$cont])
                 ->update(['idexpediente'=>$idexpediente[$cont],
                 'idasistencia'=> $asistencia->idasistencia,
                 'asistio'=> $asistentes[$cont],
                 'horaentrada' =>$vacio,
                 'horasalida'=>$vacio,
                 'observaciones'=>$observaciones[$cont]]);
                 $cont=$cont+1;
            }
        }

        DB::commit();

        }catch(\Exception $e)
        {
            DB::rollback();
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
 

public function reporte($fechainicio,$fechafin) 
    {    
         //periodo reporte
         $periodo =' '.$fechainicio.'  Hasta  '.$fechafin;
         $fechanombre = $fechainicio.' A '.$fechafin;

         // Cabiar formato fecha
         $date=new Carbon($fechainicio);
         $fechainicio = $date->format('Y-m-d');

         $date=new Carbon($fechafin);
         $fechafin = $date->format('Y-m-d');

            // validadr fecha
            if($fechainicio > $fechafin){
                Session::flash('store','La "Fecha Final" debe ser posterior a la "Fecha Inicial"');
                return Redirect::to('admin/asistencia/reporte');
            }    
       
         $detalles=DB::table('detalleasistencia as det')
            ->join('expedienteadminist as exp','exp.idexpediente','=','det.idexpediente')
            ->join('empleado as emp','emp.idempleado','=','exp.idempleado')
            ->join('asistencia as asis','asis.idasistencia','=','det.idasistencia')
            ->select('asis.fechaasistencia','asis.turno','exp.idexpediente','exp.idempleado','det.iddetalleasistencia as iddetalle','det.asistio','det.horaentrada','det.horasalida','det.observaciones',
              DB::raw("CONCAT(emp.primernombre,' ', emp.segundonombre,' ',emp.primerapellido,' ', emp.segundoapellido) as nombre"))
            ->wherebetween('asis.fechaasistencia', array($fechainicio,$fechafin))
            ->orderBy('asis.fechaasistencia','asc','asis.turno')
            ->get();

        Excel::create('Registro de Asistencia '.$fechanombre, function($excel) use($detalles,$periodo) 
        {
            $excel->sheet('Asistencia', function($sheet) use($detalles,$periodo)
            {
        
                $sheet->mergeCells('A1:H1');
                $sheet->mergeCells('A2:H2');
                $sheet->mergeCells('A3:H3');
                $sheet->mergeCells('A4:H4');
                $sheet->mergeCells('A5:H5');
                $sheet->mergeCells('A6:H6');
                $sheet->mergeCells('A7:H7');
                
                $data=[];

                array_push($data, array('UNIVERSIDAD DE EL SALVADOR'),
                                  array('FACULTAD DE INGENIERIA Y ARQUITECTURA'),
                                  array('ESCUELA DE INGENIERIA QUIMICA E INGENIERIA DE ALIMENTOS'),
                                  array(' '),
                                  array('Reporte de asistencias correspondente al periodo: '.$periodo),
                                  array(' ' ),
                                  array('Fecha',' Turno ','Asistencia','Expediente','Nombre Empleado','Hora de Entrada','Hora de Salida','Observaciones')
                );

                 $cont=8;
                
                foreach ($detalles as $det ) 
                {   
                    if($det->turno==0){
                        $det->turno="Mañana";
                    }
                    else{
                         $det->turno="Tarde";
                    }
                    
                    if($det->asistio==1)
                    {

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
                    }
                    else{
                        $det->horaentrada="---";
                        $det->horasalida="---";
                    }

                    if($det->asistio==0){
                        $det->asistio="Falta";
                    }
                    else{
                         if($det->asistio==1){
                            $det->asistio="Asistio";
                         }
                          else{
                             $det->asistio="Permiso";
                          }
                    }

                    // cambiar formato fecha
                    $date=new Carbon($det->fechaasistencia);
                    $det->fechaasistencia = $date->format('d-m-Y');

                    array_push($data, array($det->fechaasistencia, $det->turno, $det->asistio, $det->idexpediente, $det->nombre, $det->horaentrada, $det->horasalida, $det->observaciones));

                    $cont=$cont+1;
                }

                $sheet->setBorder('A8:H'.$cont, 'thin');
                $sheet->setHeight(8,30);

                $sheet->cells('A1:H8',function($cells)
                {
                    $cells->setFontWeight('bold');
                });

                $sheet->cells('A6:D6',function($cells)
                {
                    $cells->setFontColor('#C90B0B');
                });

                $sheet->cells('A1:H'.$cont,function($cells)
                {
                    $cells->setBackground('#FFFFFF');
                    $cells->setAlignment('center');
                    $cells->setValignment('center');        
                });
                
                $sheet->fromArray($data, null, 'A2', false, false);

            });

        })->download('xlsx');
        
        return Redirect::to('admin/asistencia');
            
    }

}
