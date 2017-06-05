@extends('layouts.admin')
@section('contenido')
				<div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i> <a href="{{url('/admin/expedienteadministrativo')}}"> Administrar Expediente</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-desktop"></i>
                                Gestion General de Expedientes Administrativos
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                <div class="col-lg-12">
                <label><a href="{{url('/admin/expedienteadministrativo/create')}}" class="btn btn-success btn-lg" role="button"><i class="fa fa-plus"></i> Nuevo Expediente Administrativo</a></label>
                <!--
                @include('admin.empleado.search')-->
                
                </div>
                </div>
                <div class="row">
                <div class="col-lg-12">
                @include('mensajes.messages')
                </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h2>Listado de Expedientes</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="tablaexpadmin">
                                <thead style="background-color: #A9D0F5">
                                    <tr>
                                        <th>Id</th>
                                        <th>Empleado</th>
                                        <th>Fecha Apertura</th>
                                        <th>Modalidad Contratacion</th>
                                        <th>Puesto</th>
                                        <th>Tiempo Integral</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 @foreach ($expedienteadministrativos as $exp)
                                    <tr>
                                    	<td>{{ $exp->idexpediente}}</td>
                                        <td>{{ $exp->nombrecompleto}}</td>
                                        <td>{{ $exp->fechaapertura}}</td>
                                        <td>{{ $exp->modalidadcontratacion}}</td>
                                        <td>{{ $exp->nombrepuesto}}</td>
                                        @if($exp->tiempointegral=="1")
                                        <td>Si Posee</td>
                                        @else
                                        <td>No Posee</td>
                                        @endif
                                        <td>
                                        <a href="{{URL::action('ExpedienteAdministrativoController@edit',$exp->idempleado)}}"><button type="button" class="btn btn-xs btn-primary"><i class="glyphicon  glyphicon-edit"></i> Editar</button></a>
                                        <a href="{{URL::action('ExpedienteAdministrativoController@show',$exp->idexpediente)}}"><button class="btn btn-xs btn-info"><i class="glyphicon glyphicon-list-alt"></i> Detalles</button></a>
                                        <a href="{{URL::action('EmpleadoController@perfilreport',$exp->idempleado)}}"><button class="btn btn-xs btn-success"><i class="fa fa-user"></i> Perfil</button></a>
                                        </td>
                                    </tr>
                                @endforeach 
                                </tbody>
                            </table>
                        </div>   
                    </div>
                </div>    
@endsection