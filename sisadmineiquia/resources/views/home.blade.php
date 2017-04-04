@extends('layouts.admin')
@section('contenido')

                 <!--Contenido -->
                
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>  <a href="{{url('/home')}}">Inicio</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-desktop"></i> Pagina Principal
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->


                <!-- Main jumbotron for a primary marketing message or call to action -->
                <div class="jumbotron">
                    <h1>¡Bienvenido!</h1>
                    <p>Este es sistema informático para la gestión de expedientes académicos-administrativos del recurso humano de EIQUIA-FIA-UES.</p>
                    <p>
                    </p>
                </div>
                 <div class="page-header">
                    <h1>Descripción</h1>
                </div>
                <div class="row">
                    <!-- /.col-sm-4 -->
                    <div class="col-sm-4">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <h3 class="panel-title">Control de Empleados</h3>
                            </div>
                            <div class="panel-body">
                                Adminitracion de Expediente de los Empleados.
                            </div>
                        </div>
                    </div>
                    <!-- /.col-sm-4 -->
                    <div class="col-sm-4">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <h3 class="panel-title">Control de Asistencie</h3>
                            </div>
                            <div class="panel-body">
                                Administrar el registro de asistencia y permisos de los empleados.
                            </div>
                        </div>
                    </div>
                    <!-- /.col-sm-4 -->
                    <div class="col-sm-4">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <h3 class="panel-title">Reportes</h3>
                            </div>
                            <div class="panel-body">
                                Reportes Sencillos y facil de generar.
                            </div>
                        </div>
                    </div>
                    <!-- /.col-sm-4 -->
                </div>
@endsection