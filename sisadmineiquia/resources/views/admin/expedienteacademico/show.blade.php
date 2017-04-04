@extends('layouts.admin')
@section('contenido')
				<div class="row">					
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i> <a href="{{url('/admin/expedienteacademico')}}"> Administrar Expediente Academico</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-desktop"></i>
                                Detalle Expediente Academico
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
@foreach ($expedienteacademico as $exp)
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 col-xs-offset-2">
                        
                        <div class="table-responsive">
                            <table class="table table-striped table-hover stacktable" id="tabladetalleexpacad">
                                <thead>
                                    <tr>
                                        <th>Cod. Exp</th>
                                        <th>Foto</th>
                                        <th>Nombre</th>
                                        <th>Fecha Apertura</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 
                                    <tr>
                                    	<td>{{ $exp->idexpedienteacadem}}</td>
                                        <td><img src="{{asset('fotos/empleados/'.$exp->foto)}}" class="img-responsive img-thumbnail" alt="{{$exp->nombrecompleto}}" height="300px" width="200px"></td>
                                        <td>{{ $exp->nombrecompleto}}</td>
                                        <td>{{ $exp->fechaaperturaexpacad}}</td>
                                       	@if($exp->estado=='1')
                                        <td>Activo</td>
                                        @else
                                        <td>De Baja</td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>   
                    </div>
                </div>
                <div class="page-header">
                	<h3>Datos Expediente</h3>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        
                        <div class="table-responsive">
                            <table class="table table-striped table-hover stacktable" id="tabladetalleexpacad">
                                <thead>
                                    <tr>
                                        <th>Titulo Obtenido</th>
                                        <th>Titulo de Estudio</th>
                                        <th>Institucion</th>
                                        <th>Direccion</th>
                                        <th>Descripcion</th>
                                        <th>Post-Grados</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $exp->tituloobtenido}}</td>
                                        <td>{{ $exp->tituloestudio}}</td>
                                        <td>{{ $exp->nombreinstitucion}}</td>
                                        <td>{{ $exp->direccioninstitucion}}</td>
                                        <td>{{ $exp->descripcionacademica}}</td>
                                        <td>{{ $exp->postgrados}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>   
                    </div>
                </div>
@endforeach
				@if(count($experiencialaboral)!=0)
                <div class="page-header">
                	<h3>Experiencia Laboral Academica</h3>
                </div>    
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        
                        <div class="table-responsive">
                            <table class="table table-striped table-hover stacktable" id="tabladetalleexpadmin">
                                <thead>
                                    <tr>
                                        <th>Descripcion</th>
                                        <th>Institucion</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Finalizacion</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                @foreach ($experiencialaboral as $explab) 
                                    <tr>
                                    	<td>{{ $explab->descripcionexplab}}</td>
                                        <td>{{ $explab->nombreinstitucionexplabacad}}</td>
                                        <td>{{ $explab->fechainicioexplabacad}}</td>
                                        <td>{{ $explab->fechafinalizacionexplabacad}}</td>
                                    </tr>
                                @endforeach 
                                </tbody>
                            </table>
                        </div>   
                    </div>
                </div>
                @endif
                @if(count($asignacionacademica)!=0)
                <div class="page-header">
                	<h3>Asignaciones Academicas</h3>
                </div>
                <div class="row">
        		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            	<div class="table-responsive">
                <table class="table table-striped table-hover stacktable" id="tabladetalleacuerdos">
                    <thead>
                        <tr>
                            <th>Año</th>
                            <th>Ciclo</th>
                            <th>Cod. Asignatura</th>
                            <th>Nombre</th>
                            <th>GT</th>
                            <th>GD</th>
                            <th>GL</th>
                            <th>Tiempo Total</th>
                            <th>Resposabilidades Administrativas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($asignacionacademica as $asig)
                            <tr>
                                <td>{{$asig->ano }}</td>
                                <td>{{$asig->idciclo }}</td>
                                <td>{{$asig->codasignatura }}</td>
                                <td>{{$asig->nombreasignatura}}</td>
                                <td>{{$asig->gteorico }}</td>
                                <td>{{$asig->gdiscusion }}</td>
                                <td>{{$asig->glaboratorio }}</td>
                                <td>{{$asig->tiempototal }}</td>
                                <td>{{$asig->responsabilidadadmin }}</td>
                            <tr>
                        @endforeach 
                    </tbody>
                </table>
            	</div>
        		</div> 
        		</div>
        		@endif                 
@endsection