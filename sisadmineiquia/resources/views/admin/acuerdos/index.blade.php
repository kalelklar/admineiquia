@extends('layouts.admin')
@section('contenido')
	
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i> <a href="{{url('/admin/acuerdos')}}"> Gestionar Acuerdos</a>
                </li>
                <li class="active">
                    <i class="fa fa-desktop"></i> Administrar Acuerdos
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
    <div class="col-lg-12">
        <label><a href="{{url('admin/acuerdos/create')}}" class="btn btn-success btn-lg" role="button"><i class="fa fa-plus "></i> Nuevo Acuerdo Administrativo</a></label>
    </div>
    </div>
    <div class="row">
    <div class="col-lg-12">
        
        @include('mensajes.messages') 

    </div>
    </div>
                 
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h2>Listado de Acuerdos Administrativos</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="tablaacuerdos">
                    <thead style="background-color: #A9D0F5">
                        <tr>
                            <th>Código</th>
                            <th>Archivo</th>
                            <th>Empleado</th>
                            <th>Motivo</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($acuerdos as $ac)
                            <tr>
                                <td>{{ $ac->idacuerdo }}</td>
                                <td>
                                @if(($ac->archivoacuerdo)!="")
                                    <a href="{{ URL::asset('acuerdos/'.$ac->archivoacuerdo) }}" target="_blank">
                                        {{ $ac->idacuerdo }}
                                    </a>
                                @endif
                                </td>
                                <td>{{ $ac->nombrecompleto }}</td>
                                <td>{{ $ac->motivoacuerdo }}</td>
                                @if($ac->estadoacuerdo=='1')
                                                    <td>Aprobado</td>
                                                    @else
                                                     <td>No Aprobado</td>
                                                    @endif
                                <td>{{ $ac->fechaacuerdo }}</td>
                                <td>
                                    <a href="{{URL::action('AcuerdosController@edit',$ac->idacuerdo)}}"><button type="button" class="btn btn-xs btn-primary"><i class="glyphicon  glyphicon-edit"></i> Editar</button></a>
                                    <a href="" data-target="#modal-delete-{{$ac->idacuerdo}}" data-toggle="modal"><button class="btn btn-xs btn-danger"><i class="fa fa-remove"></i> Eliminar</button></a>
                                    <a href="" data-target="#modal-delete2-{{$ac->idacuerdo}}" data-toggle="modal"><button  class="btn btn-xs btn-success"><i class="glyphicon glyphicon-retweet"></i> Cambiar Estado</button></a>
                                    </td>
                                </tr>
                                @include('admin.acuerdos.modal')
                        @endforeach 
                    </tbody>
                </table>
            </div>
            {{$acuerdos->render()}}    
        </div>    
@endsection