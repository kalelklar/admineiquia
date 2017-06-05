@extends('layouts.admin')
@section('contenido')
				<div class="row">					
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i> <a href="{{url('/admin/empleado')}}"> Administrar Expediente Administrativo</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-desktop"></i>
                                Detalle Expediente Administrativo
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
@foreach ($expedienteadministrativos as $exp)
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 col-xs-offset-2">
                        
                        <div class="table-responsive">
                            <table class="table table-striped table-hover stacktable" id="tabladetalleexpadmin">
                                <thead style="background-color: #A9D0F5">
                                    <tr>
                                        <th>Cod. Exp</th>
                                        <th>Foto</th>
                                        <th>Nombre</th>
                                        <th>Sexo</th>
                                        <th>Fecha Apertura</th>
                                        <th>Modalidad Contratacion</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 
                                    <tr>
                                    	<td>{{ $exp->idexpediente}}</td>
                                        <td><img src="{{asset('fotos/empleados/'.$exp->foto)}}" class="img-responsive img-thumbnail" alt="{{$exp->nombrecompleto}}" height="300px" width="200px"></td>
                                        <td>{{ $exp->nombrecompleto}}</td>
                                        <td>{{ $exp->sexo}}</td>
                                        <td>{{ $exp->fechaapertura}}</td>
                                        <td>{{ $exp->modalidadcontratacion}}</td>
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
                	<h3>Documentos</h3>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div style="overflow-x:auto;">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover stacktable" id="tabladetalleexpadmin">
                                <thead>
                                    <tr>
                                        <th>Dui</th>
                                        <th>Nit</th>
                                        <th>Isss</th>
                                        <th>AFP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 
                                    <tr>
                                    	<td>{{ $exp->dui}}</td>
                                        <td>{{ $exp->nit}}</td>
                                        <td>{{ $exp->isss}}</td>
                                        <td>{{ $exp->afp}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        </div>    
                    </div>
                </div>
                <div class="page-header">
                	<h3>Datos Expediente</h3>
                </div>    
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div style="overflow-x:auto;">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover stacktable" id="tabladetalleexpadmin">
                                <thead>
                                    <tr>
                                        <th>Cod. Contrato</th>
                                        <th>Tiempo Integral</th>
                                        <th>Descripcion Exp.</th>
                                        <th>Puesto</th>
                                        <th>Salario del Puesto</th>
                                        <th>Departamento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 
                                    <tr>
                                    	<td>{{ $exp->codigocontrato}}</td>
                                    	@if($exp->tiempointegral=='1')
                                        <td>Si Posee</td>
                                        @else
										<td>No Posee</td>
                                        @endif
                                        <td>{{ $exp->descripcionadmin}}</td>
                                        <td>{{ $exp->nombrepuesto}}</td>
                                        <td>{{ $exp->salariopuesto}}</td>
                                        <td>{{ $exp->nombredepartamento}}</td>
                                    </tr>
                                @endforeach 
                                </tbody>
                            </table>
                        </div>
                        </div>   
                    </div>
                </div>
                @if(count($acuerdos)!=0)
                <div class="page-header">
                	<h3>Acuerdos Asociados</h3>
                </div>
                <div class="row">
        		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div style="overflow-x:auto;">
            	<div class="table-responsive">
                <table class="table table-striped table-hover stacktable" id="tabladetalleacuerdos">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Motivo</th>
                            <th>Estado</th>
                            <th>Fecha</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($acuerdos as $ac)
                            <tr>
                                <td>{{$ac->idacuerdo }}</td>
                                <td>{{ $ac->motivoacuerdo }}</td>
                                @if($ac->estadoacuerdo=='1')
                                                    <td>Aprobado</td>
                                                    @else
                                                     <td>No Aprobado</td>
                                                    @endif
                                <td>{{ $ac->fechaacuerdo }}</td>
                            <tr>
                        @endforeach 
                    </tbody>
                </table>
            	</div>
        		</div>
                </div> 
        		</div>
                @endif
                @if(count($tiempo)!=0)
        		<div class="page-header">
                	<h3>Tiempo Adicional Asociados</h3>
                </div>
                <div class="row">
        		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            	<div class="table-responsive">
                <table class="table table-striped table-hover stacktable" id="tabladetalletiempoadicional">
                    <thead>
                        <tr>
                            <th>Año</th>
                            <th>Ciclo</th>
                            <th>Fecha de Inicio</th>
                            <th>Fecha de Fin</th>
                            <th>Descripcion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tiempo as $t)
                            <tr>
                                <td>{{$t->ano }}</td>
                                <td>{{$t->idciclo }}</td> 
                                <td>{{$t->fechainicio}}</td>
                                <td>{{$t->fechafin}}</td>
                                <td>{{$t->descripcion}}</td>   
                            <tr>
                        @endforeach 
                    </tbody>
                </table>
            	</div>
        		</div> 
        		</div>
                @endif                  
@endsection