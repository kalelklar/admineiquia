@extends('layouts.admin')
@section('contenido')
				<div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i> <a href="/admin/cargaacademica"> Administrar Carga Academica</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-desktop"></i>
                                Gestion General de Carga Academica
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="col-lg-12">
                <label><a href="cargaacademica/create" class="btn btn-primary btn-lg" role="button">Nueva Carga Academica</a></label>

                <!--
                @include('admin.empleado.search')-->
                @include('mensajes.messages')
 

                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h2>Listado de Carga Academica</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="tablaexpadmin">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Empleado</th>
                                        <th>Codigo Asignatura</th>
                                        <th>Nombre Asignatura</th>
                                        <th>Ciclo</th>
                                        <th>Año</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 @foreach ($cargaacademicas as $cargaacad)
                                    <tr>
                                        <td>{{ $cargaacad->idasignacionacad}}</td>
                                        <td>{{ $cargaacad->nombrecompleto}}</td>
                                    	<td>{{ $cargaacad->codasignatura}}</td>
                                        <td>{{ $cargaacad->nombreasignatura}}</td>
                                        <td>{{ $cargaacad->idciclo}}</td>
                                        <td>{{ $cargaacad->ano}}</td>
                                        <td>
                                         <a href="{{URL::action('AsignacionAcademicaController@edit',$cargaacad->idasignacionacad)}}"><button type="button" class="btn btn-xs btn-primary">Editar Carga Academica</button></a>
                                         <a href="" data-target="#modal-delete-{{$cargaacad->idasignacionacad}}" data-toggle="modal"><button class="btn btn-xs btn-danger">Eliminar</button></a>

                                         <a href="{{URL::action('AsignacionAcademicaController@asignacionacadreport',$cargaacad->idasignacionacad)}}"><button class="btn btn-xs btn-success">Imprimir</button></a>
                                         

                                        </td>
                                    </tr>
                                    @include('admin.cargaacademica.modal')
                                @endforeach 
                                </tbody>
                            </table>
                        </div>   
                    </div>
                </div>    
@endsection