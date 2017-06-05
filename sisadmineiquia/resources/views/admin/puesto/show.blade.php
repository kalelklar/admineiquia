@extends('layouts.admin')
@section('contenido')
				<div class="row">					
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i> <a href="{{url('/admin/puesto')}}"> Administrar puesto</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-desktop"></i>
                                Detalle Puesto
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
@foreach ($puesto as $pue)
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 col-xs-offset-2">
                        <h3>Detalles del Puesto</h3><br>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover stacktable" id="tabladetallepuesto">
                                <thead style="background-color: #A9D0F5">
                                    <tr>
                                        <th>Cod</th>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>Salario</th>
                                        <th>Departamento</th>
                                        <th>Descripcion del Departamento</th>
                                    </tr>
                                </thead>
                                <tbody>       
                                    <tr>
                                    	<td>{{ $pue->idpuesto}}</td>
                                        <td>{{ $pue->nombrepuesto}}</td>
                                        <td>{{ $pue->descripcionpuesto}}</td>
                                        <td>{{ $pue->salariopuesto}}</td>
                                        <td>{{ $pue->nombredepartamento}}</td>
                                        <td>{{ $pue->descripciondeparta}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>   
                    </div>
                </div> 
                <div class="page-header">
                	<h3>Datos del Perfil de Puesto</h3>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  
                        <div class="table-responsive">
                            <table class="table table-striped table-hover stacktable" id="tabladetalleexpacad">
                                <thead style="background-color: #A9D0F5">
                                    <tr>
                                        <th>Profesion</th>
                                        <th>Reporta a</th>
                                        <th>Sustituto</th>
                                        <th>Relaciones</th>
                                        <th>Responsabilidades</th>
                                        <th>Sustituye a</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $pue->profesion}}</td>
                                        <td>{{ $pue->reporta}}</td>
                                        <td>{{ $pue->sustituto}}</td>
                                        <td>{{ $pue->relaciones}}</td>
                                        <td>{{ $pue->responsabilidades}}</td>
                                        <td>{{ $pue->sustituye}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>   
                    </div>
                </div>

    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="btn_guardar"> 
        <div class="form-group">
          <a href="{{url('admin/asistencia')}}" class="btn btn-danger" role="button">
          <i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
        </div>
      </div>
    </div> 
@endforeach
@endsection