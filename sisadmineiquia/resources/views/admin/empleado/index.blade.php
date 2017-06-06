@extends('layouts.admin')
@section('contenido')
				<div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i> <a href="{{url('/admin/empleado')}}"> Administrar Empleados</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-desktop"></i>
                                Gestion de Empleados
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="col-lg-12">
                <label><a href="{{url('/admin/expedienteadministrativo')}}" class="btn btn-primary btn-lg" role="button"><i class="fa fa-folder-open"></i>  Expediente Administrativo</a></label>
                <label><a href="{{url('/admin/expedienteacademico')}}" class="btn btn-primary btn-lg" role="button"><i class="glyphicon glyphicon-education"></i> Expediente Academico</a></label>
                </div>
                <div class="row">
                <div class="col-lg-12">
                @include('mensajes.messages')
                </div>
                </div>
                
                <!-- /.row -->
                <div class="row">
                <div class="col-lg-12">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><h1>Listado de Empleados</h1></div>

                            </div>
                                <div class="span12">
                                   <div class="table-toolbar">
                                      <div class="btn-group">
                                         <a href="{{url('/admin/empleado/create')}}"><button class="btn btn-success">Agregar Nuevo <i class="fa fa-plus"></i></button></a>
                                      </div>
                                      <div class="btn-group pull-right">
                                         <button data-toggle="dropdown" class="btn btn-primary" class="btn dropdown-toggle"><i class="glyphicon glyphicon-save-file"></i> Opciones <span class="caret"></span></button>
                                         <ul class="dropdown-menu">
                                            <li><a href="{{url('/admin/empleado/nominareport')}}">Generar Nomina Como PDF</a></li>
                                            <li><a href="{{url('/admin/empleado/nominareportdownload')}}">Descargar Nomina Como PDF</a></li>
                                         </ul>
                                      </div>
                                   </div><br><br>
                                        <table class="table table-bordered table-hover" id="tablaempleado">
                                            <thead style="background-color: #A9D0F5">
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Foto</th>
                                                    <th>Nombre</th>
                                                    <th>Dui</th>
                                                    <th>Nit</th>
                                                    <th>Estado</th>
                                                    <th>Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                             @foreach ($empleados as $emp)
                                                <tr>
                                                	<td>{{ $emp->idempleado }}</td>
                                                    <td>
                                                        <img src="{{asset('fotos/empleados/'.$emp->foto)}}" alt="{{$emp->nombrecompleto}}" height="110px" width="110px" class="img-thumbnail">

                                                    </td>
                                                    <td>{{ $emp->nombrecompleto }}</td>
                                                    <td>{{ $emp->dui}}</td>
                                                    <td>{{ $emp->nit }}</td>
                                                    @if($emp->estado=='1')
                                                    <td>Activo</td>
                                                    @else
                                                     <td>De Baja</td>
                                                    @endif
                                                    <td>
                                                    <a href="{{URL::action('EmpleadoController@edit',$emp->idempleado)}}"><button type="button" class="btn btn-xs btn-primary"><i class="glyphicon  glyphicon-edit"></i> Editar </button></a>
                                                    <a href="" data-target="#modal-delete-{{$emp->idempleado}}" data-toggle="modal"><button  class="btn btn-xs btn-danger"><i class="fa fa-retweet"></i> Estado</button></a>
                                                    <a href="{{URL::action('EmpleadoController@perfilreport',$emp->idempleado)}}"><button class="btn btn-xs btn-success"><i class="fa fa-user"></i> Perfil</button></a>
                                                    </td>
                                                </tr>
                                                @include('admin.empleado.modal')
                                            @endforeach 
                                            </tbody>
                                        </table>
                                </div>
                        </div>   
                    </div>
                    </div>     
@endsection