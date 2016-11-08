@extends('layouts.admin')
@section('contenido')
				<div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i> <a href="/admin/experiencialaboralacademica"> Administrar Experiencia Academica</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-desktop"></i>
                                Gestion General de Experiencia Academica
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="col-lg-12">
                <label><a href="experiencialaboralacademica/create" class="btn btn-primary btn-lg" role="button">Crear Experiencia</a></label>
                <!--
                @include('admin.empleado.search')-->
                @include('mensajes.messages')
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h2>Listado de Experiencias Laboral Academica</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="tablaexplabacad">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Empleado</th>
                                        <th>Nombre de la Institucion</th>
                                        <th>Descripcion</th>
                                        <th>Fecha de Inicio</th>
                                        <th>Fecha de Fin</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 @foreach ($experiencias as $explab)
                                    <tr>
                                    	<td>{{ $explab->idexplabacademica}}</td>
                                        <td>{{ $explab->nombrecompleto}}</td>
                                        <td>{{ $explab->descripcionexplab}}</td>
                                        <td>{{ $explab->nombreinstitucionexplabacad}}</td>
                                        <td>{{ $explab->fechainicioexplabacad}}</td>
                                        <td>{{ $explab->fechafinalizacionexplabacad}}</td>
                                        <td>
                                        <a href="{{URL::action('ExperienciaLaboralAcademicaController@edit',$explab->idexplabacademica)}}"><button type="button" class="btn btn-sm btn-primary">Editar Experiencia Academica</button></a>
                                        </td>
                                    </tr>
                                @endforeach 
                                </tbody>
                            </table>
                        </div>   
                    </div>
                </div>    
@endsection