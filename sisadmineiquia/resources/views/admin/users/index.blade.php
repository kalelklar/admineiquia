@extends('layouts.admin')
@section('contenido')
				<div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i> <a href="{{url('/admin/users')}}"> Administrar Usuarios</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-desktop"></i>
                                Gestion General de Usuarios
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="col-lg-12">
                <label><a href="{{ route('admin.users.create') }}" class="btn btn-success btn-lg" role="button"><i class="glyphicon glyphicon-plus"></i> Nuevo Usuario</a></label>
                <!--
                @include('admin.empleado.search')-->
                @include('mensajes.messages')
            
                 </div>
                 
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h2>Listado de Usuarios</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="tablausers">
                                <thead style="background-color: #A9D0F5">
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>email</th>
                                        <th>Tipo</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 @foreach ($users as $u)
                                    <tr>
                                    	<td>{{ $u->id}}</td>
                                        <td>{{ $u->name }}</td>
                                        <td>{{ $u->email }}</td>
                                        @if($u->type=='adminsist')
                                        <td>Administrador del Sistema</td>
                                        @endif
                                        @if($u->type=='admin')
                                        <td>Administrador</td>
                                        @endif
                                        @if($u->type=='secret')
                                        <td>Secretaria</td>
                                        @endif
                                        <td>
                                        <a href="{{URL::action('UsersController@edit',$u->id)}}"><button type="button" class="btn btn-xs btn-primary"><i class="glyphicon  glyphicon-edit"></i> Editar</button></a>
                                        <a href="" data-target="#modal-delete-{{$u->id}}" data-toggle="modal"><button  class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove-circle"></i> Eliminar</button></a>
                                        </td>
                                    </tr>
                                    @include('admin.users.modal')
                                @endforeach 
                                </tbody>
                            </table>
                        </div>   
                    </div>    
@endsection