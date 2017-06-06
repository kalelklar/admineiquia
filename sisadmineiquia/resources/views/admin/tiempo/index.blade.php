@extends('layouts.admin')
@section('contenido')
				<div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i> <a href="{{url('/admin/tiempo')}}"> Administrar Tiempo Adicional</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-desktop"></i>
                                Gestionar Tiempo Adicional
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="col-lg-12">
                <label><a href="{{url('admin/tiempo/create')}}" class="btn btn-success btn-lg" role="button"><i class="fa fa-plus"></i> Crear Tiempo</a></label>

                <!--
                @include('admin.empleado.search')-->
                @include('mensajes.messages')
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h2>Listado de Tiempos Adicionales</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="tablatiempo">
                                <thead style="background-color: #A9D0F5">
                                    <tr>
                                        <th>Id. Exp</th>
                                        <th>Empleado</th>
                                        <th>Año</th>
                                        <th>Ciclo</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Fin</th>
                                        <th>Descripcion</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 @foreach ($tiempos as $t)
                                    <tr>
                                        <td>{{ $t->idexpediente}}</td>
                                        <td>{{ $t->nombrecompleto}}</td>
                                    	<td>{{ $t->ano}}</td>
                                        <td>{{ $t->idciclo}}</td>
                                        <td>{{ $t->fechainicio}}</td>
                                        <td>{{ $t->fechafin}}</td>
                                        <td>{{ $t->descripcion}}</td>
                                        <td>
                                         <a href="{{URL::action('TiempoAdicionalController@edit',$t->idtiempo)}}"><button type="button" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</button></a>
                                         <a href="" data-target="#modal-delete-{{$t->idtiempo}}" data-toggle="modal"><button class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i> Eliminar</button></a>
                                        </td>
                                    </tr>
                                    @include('admin.tiempo.modal')
                                @endforeach 
                                </tbody>
                            </table>
                        </div>   
                    </div>
                </div>    
@endsection