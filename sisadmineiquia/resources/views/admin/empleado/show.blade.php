<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RRHHEIQUIA - FIAUES</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ public_path()}}/css/perfilempleado.css" rel="stylesheet">

  

    <!-- Custom Fonts -->
    <!--<link href="{{asset('font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">-->

    <!-- Custom datatable CSS -->
   <!--<link href="{{asset('css/jquery.dataTables.min.css')}}" rel="stylesheet">-->
    <!-- <link href="{{asset('css/dataTables.bootstrap.min.css')}}" rel="stylesheet">-->



    <!-- Estilo de calendarios -->
    <!--<link rel="stylesheet" href="{{asset('css/tcal.css')}}"></script>-->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div id="contenedor">
<!--Contenido -->
@foreach ($empleado as $emp)
<header>
    <div id="titulo">
        <div id="logo">
        @if(is_file(public_path().'/fotos/empleados/'.$emp->foto))
        <div class="foto">
            <img src="{{ public_path()}}/fotos/empleados/{{$emp->foto}}" alt="{{$emp->nombrecompleto}}" height="110px" width="110px" class="img-thumbnail">
        </div>
        @else
        <div class="foto">
            <img src=""  class="img-thumbnail">
        </div>
        @endif
        </div>
        <h3>{{$emp->nombrecompleto}}</h3>
        @if($emp->estado=='1')
        <h3><b>Estado:</b> Activo</h3>
        @else
        <h3><b>Estado:</b> De Baja</h3>
        @endif
        @if($emp->sexo=='M')
        <h3><b>Sexo: </b> Masculino</h3>
        @else
        <h3><b>Sexo: </b> Femenino</h3>
        @endif
    </div>
    <div style="clear:both;"></div>
</header>
<div id="datospersonales">
    <h2><b>Datos Personales<b></h2>
    <div style="overflow-x:auto;">
                <div class="table-responsive table-bordered">
                    <table class="table" id="tablanommina">
                        <thead>
                            <tr>
                                <th>Dui</th>
                                <th>Nit</th>
                                <th>Isss</th>
                                <th>Afp</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$emp->dui}}</td>
                                <td>{{$emp->nit}}</td>
                                <td>{{$emp->isss}}</td>
                                <td>{{$emp->afp}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div> 
    </div>
@endforeach
@if($expedienteadministrativo==null)
@else
<div id="datosexpadmin">
    <div class="page-header">
        <h2>Datos Expediente</h2>
    </div>    
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div style="overflow-x:auto;">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="tabladetalleexpadmin">
                    <thead>
                        <tr>
                            <th>Cod. Acuerdo</th>
                            <th>Modalidad Contratacion</th>
                            <th>Tiempo Integral</th>
                            <th>Descripcion Exp.</th>
                            <th>Puesto</th>
                            <th>Salario del Puesto</th>
                            <th>Departamento</th>
                        </tr>
                    </thead>
                    @foreach ($expedienteadministrativo as $expadmin)
                    <tbody>
                        <tr>
                            <td>{{ $expadmin->codigocontrato}}</td>
                            <td>{{ $expadmin->modalidadcontratacion}}</td>
                            @if($expadmin->tiempointegral=='1')
                            <td>Si Posee</td>
                            @else
                            <td>No Posee</td>
                            @endif
                            <td>{{ $expadmin->descripcionadmin}}</td>
                            <td>{{ $expadmin->nombrepuesto}}</td>
                            <td>{{ $expadmin->salariopuesto}}</td>
                            <td>{{ $expadmin->nombredepartamento}}</td>
                        </tr>
                    </tbody>
                     @endforeach
                </table>
            </div>   
        </div>
        </div>
    </div>
</div>
@endif
@if(count($acuerdos)!=0)
<div id="datosacuerdo">
    <div class="page-header">
        <h2>Acuerdos Asociados</h2>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="tabladetalleacuerdos">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Motivo</th>
                            <th>Estado</th>
                            <th>Fecha</th>

                        </tr>
                    </thead>
                    @foreach ($acuerdos as $ac)
                    <tbody>
                        <tr>
                            <td>{{$ac->idacuerdo }}</td>
                            <td>{{ $ac->motivoacuerdo }}</td>
                            @if($ac->estadoacuerdo=='1')
                            <td>Aprobado</td>
                            @else
                            <td>No Aprobado</td>
                            @endif
                            <td>{{ $ac->fechaacuerdo }}</td>
                        </tr>
                    </tbody>
                    @endforeach 
                </table>
            </div>
        </div> 
    </div>
</div>
@endif
@if(count($tiempo)!=0)
<div id="datostiempo">
    <div class="page-header">
        <h2>Tiempo Adicional Asociados</h2>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="tabladetalletiempoadicional">
                    <thead>
                        <tr>
                            <th>Año</th>
                            <th>Ciclo</th>
                            <th>Fecha de Inicio</th>
                            <th>Fecha de Fin</th>
                            <th>Descripcion</th>
                        </tr>
                    </thead>
                    @foreach ($tiempo as $t)
                    <tbody>
                        <tr>
                            <td>{{$t->ano }}</td>
                            <td>{{$t->idciclo }}</td> 
                            <td>{{$t->fechainicio}}</td>
                            <td>{{$t->fechafin}}</td>
                            <td>{{$t->descripcion}}</td>   
                        </tr> 
                    </tbody>
                    @endforeach 
                </table>
            </div>
        </div> 
    </div>
</div>
@endif
<!-- Fin Contenido-->
</div>
</body>
</html>