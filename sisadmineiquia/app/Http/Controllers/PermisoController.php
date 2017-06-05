<?php

namespace sisadmineiquia\Http\Controllers;

use Illuminate\Http\Request;
use sisadmineiquia\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use sisadmineiquia\Http\Requests\PermisoFormRequest;
use Maatwebsite\Excel\Facades\Excel;
use sisadmineiquia\Permiso;
use Carbon\Carbon;
use Session;
use DB;

class PermisoController extends Controller
{
   public function __construct()
    {

    } 

    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('year'));
            
            if ($query!=null){

               return $this->reporte($query);
            }
        }

            $permisos=DB::table('permiso as p')
            ->join('expedienteadminist as exp','exp.idexpediente','=','p.idexpediente')
            ->join('empleado as emp','emp.idempleado','=','exp.idempleado')
            ->select('exp.idexpediente','exp.idempleado','p.idpermiso','p.fechasolicitud','p.motivopermiso','p.tiemposolicitadohora','p.tiemposolicitadomin','p.gocesueldo','p.estadopermiso','p.fechapermiso',DB::raw("CONCAT(emp.primernombre,' ', emp.segundonombre,' ',emp.primerapellido,' ', emp.segundoapellido) as nombre"))
            ->get();
            
            return view('admin.permiso.index',["permisos"=>$permisos]);
    }

    public function create()
    {   
        $empleados=DB::table('expedienteadminist as exp')
            ->join('empleado as emp','emp.idempleado','=','exp.idempleado')
            ->join('puesto as p','p.idpuesto','=','exp.idpuesto')
            ->select('exp.idexpediente','exp.idempleado','p.nombrepuesto',DB::raw("CONCAT(emp.primernombre,' ', emp.segundonombre,' ',emp.primerapellido,' ', emp.segundoapellido) as nombre"))->get();

    	return view("admin.permiso.create",["empleados"=>$empleados]);
    }

    public function store(PermisoFormRequest $request)
    {
        if ($request)
        {  

          $permiso=new Permiso;
          $exped=$request->get('idexpediente');
          
          //separar idexpediente_puesto 
             for($i=0; $i<strlen($exped); $i++)
             {
                if($exped[$i]!="_"){
                    $idexpediente[$i]=$exped[$i];
                }
                else{
                    $i=strlen($exped);
                }                    
             }
           // convertir el arrar a string  
          $exped=implode($idexpediente);

          //consultar todos los permisos asosciados al expdeiente 
          $permisos=DB::table('permiso as p')
            ->join('expedienteadminist as exp','exp.idexpediente','=','p.idexpediente')
            ->select('p.fechasolicitud')
            ->where('exp.idexpediente','=',$exped)
            ->get();

          //contar cuantos permisos tiene el empleado
          $date = Carbon::now()->year;
          $anyof1=$date;

          $nump=0;

            foreach ($permisos as $per)
            {     
                $f2=$per->fechasolicitud;
                $anyof2=$f2[6].$f2[7].$f2[8].$f2[9];
            
                if($anyof1==$anyof2){
                    $nump=$nump+1;
                }
            }

          // validadcion Si cumple se agrega el permiso
          if($nump>=15){

             Session::flash('store','¡El empleado ya ha alcanzado el maximo de permisos!'); 
             return Redirect::to('admin/permiso/create'); 
            }
            else{

             $idexpediente=implode($idexpediente);
             $permiso->idexpediente=$idexpediente;
             $permiso->fechasolicitud=$request->get('fechasolicitud');
             $permiso->motivopermiso=$request->get('motivopermiso');
             $permiso->tiemposolicitadohora=$request->get('tiemposolicitadohora');
             $permiso->tiemposolicitadomin=$request->get('tiemposolicitadomin');
             $permiso->gocesueldo=$request->get('gocesueldo');
             $permiso->estadopermiso=$request->get('estadopermiso');
             $permiso->fechapermiso=$request->get('fechapermiso');
             $permiso->save();

             Session::flash('store','¡El permiso se ha creado correctamente!');
             return Redirect::to('admin/permiso');
            }
        }
         else{
             return Redirect::to('admin/permiso/create');
            }
    }

    public function show($id)
    {
    
    }

    public function edit($id)
    {   
        $permiso=DB::table('permiso as p')
            ->join('expedienteadminist as exp','exp.idexpediente','=','p.idexpediente')
            ->join('empleado as emp','emp.idempleado','=','exp.idempleado')
            ->join('puesto as pt','pt.idpuesto','=','exp.idpuesto')
            ->select('exp.idexpediente','exp.idempleado','p.idpermiso','p.fechasolicitud','p.motivopermiso','p.tiemposolicitadohora',
                     'p.tiemposolicitadomin','p.gocesueldo','p.estadopermiso','p.fechapermiso','pt.nombrepuesto',
             DB::raw("CONCAT(emp.primernombre,' ', emp.segundonombre,' ',emp.primerapellido,' ', emp.segundoapellido) as nombre"))
            ->where('p.idpermiso','=',$id)
            ->get();

        $empleados=DB::table('expedienteadminist as exp')
            ->join('empleado as emp','emp.idempleado','=','exp.idempleado')
            ->join('puesto as p','p.idpuesto','=','exp.idpuesto')
            ->select('exp.idexpediente','exp.idempleado','p.nombrepuesto',DB::raw("CONCAT(emp.primernombre,' ', emp.segundonombre,' ',emp.primerapellido,' ', emp.segundoapellido) as nombre"))->get();
            
        return view("admin.permiso.edit",["permiso"=>$permiso,"empleados"=>$empleados]);
    }

    public function update(PermisoFormRequest $request,$id)
    {   
        
        $affectedRows = Permiso::where('idpermiso','=',$id)
        ->update([
            'fechasolicitud'=>$request->get('fechasolicitud'),
            'motivopermiso' =>$request->get('motivopermiso'),
            'tiemposolicitadohora' =>$request->get('tiemposolicitadohora'),
            'tiemposolicitadomin' =>$request->get('tiemposolicitadomin'),
            'gocesueldo'=>$request->get('gocesueldo'),
            'estadopermiso'=>$request->get('estadopermiso'),
            'fechapermiso'=>$request->get('fechapermiso')]);

        Session::flash('update','¡El permiso se ha actualizado correctamente!');       
        return Redirect::to('admin/permiso');
    }

    public function destroy($id)
    {
        $affectedRows = Permiso::where('idpermiso','=',$id)->delete();
        Session::flash('destroy','¡El permiso fue eliminado correctamente!');
        return Redirect::to('admin/permiso');    
    }

    public function reporte($year) 
    {  
        if($year<2000 || $year>2200){

          Session::flash('store','Ingrese una fecha valida');
            return Redirect::to('admin/permiso/reporte');
        }
         
        $date = $year;
        Excel::create('Registro de Permisos año '.$year, function($excel) use($year) 
        {
            
            $excel->sheet('Permisos', function($sheet) use($year)
            {   

                $expedientes=DB::table('expedienteadminist as exp')
                ->join('permiso as p','p.idexpediente','=','exp.idexpediente')
                ->distinct()
                ->select('exp.idexpediente')
                ->get();

                $sheet->mergeCells('A1:D1');
                $sheet->mergeCells('A2:D2');
                $sheet->mergeCells('A3:D3');
                $sheet->mergeCells('A4:D4');
                $sheet->mergeCells('A5:D5');
                $sheet->mergeCells('A6:D6');
                $sheet->mergeCells('A7:D7');

                $data=[];
                array_push($data, array('UNIVERSIDAD DE EL SALVADOR'),
                                  array('FACULTAD DE INGENIERIA Y ARQUITECTURA'),
                                  array('ESCUELA DE INGENIERIA QUIMICA E INGENIERIA DE ALIMENTOS'),
                                  array(' '),
                                  array('Resumen de permisos aprobados correspondentes al año: '.$year),
                                  array(' ' ),
                                  array('Expediente','Nombre Empleado','N° Aprobados ','Tiempo total otorgado')
                                );
                $cont=8;
                foreach ($expedientes as $exp) 
                {

                    $permisos=DB::table('permiso as p')
                    ->join('expedienteadminist as exp','exp.idexpediente','=','p.idexpediente')
                    ->join('empleado as emp','emp.idempleado','=','exp.idempleado')
                    ->where('p.idexpediente','=',$exp->idexpediente)
                    ->where('p.fechapermiso','LIKE','%'.$year.'%')
                    ->select('exp.idexpediente','p.idpermiso','p.tiemposolicitadohora','p.tiemposolicitadomin',
                    DB::raw("CONCAT(emp.primernombre,' ', emp.segundonombre,' ',emp.primerapellido,' ', emp.segundoapellido) as nombre"),
                    DB::raw('count(*) as permiso_count'),
                    DB::raw('sum(p.tiemposolicitadohora) as horas_count'),
                    DB::raw('sum(p.tiemposolicitadomin) as min_count'))
                    ->get();

                    $cont=$cont+1;
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
                        
                        if($per->permiso_count==0)
                            array_push($data, array($per->idexpediente, $per->nombre, ' Cero ', ' --- '));
                        else
                        array_push($data, array($per->idexpediente, $per->nombre, $cant_permiso, $horas.' horas con '.$min.' minutos'));
                      }
                    
                }

                $sheet->setBorder('A8:D'.$cont,'thin');
                $sheet->setHeight(8,30);

                $sheet->cells('A1:D8',function($cells)
                {
                    $cells->setFontWeight('bold');
                });

                $sheet->cells('A6:D6',function($cells)
                {
                    $cells->setFontColor('#C90B0B');
                });

                $sheet->cells('A1:D'.$cont,function($cells)
                {
                    $cells->setBackground('#FFFFFF');
                    $cells->setAlignment('center');
                    $cells->setValignment('center');        
                });
 
                 $sheet->fromArray($data, null, 'A2', false, false);

            });


        })->download('xlsx');

       return Redirect::to('admin/permiso');        
    }

}
