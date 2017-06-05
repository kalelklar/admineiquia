<?php
//error_reporting(0);
//session_start();
?>
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
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">


    <!-- Custom Fonts -->
    <link href="{{asset('font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Custom datatable CSS -->
    <link href="{{asset('css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <!-- <link href="{{asset('css/dataTables.bootstrap.min.css')}}" rel="stylesheet">-->

    <!-- Select-->
    <link href="{{asset('css/bootstrap-select.min.css')}}" rel="stylesheet">

    <!-- Picker -->
    <link href="{{asset('css/jquery.timepicker.css')}}" rel="stylesheet">

    

      <!-- Custom CSS -->
    <link href="{{asset('css/sb-admin.css')}}" rel="stylesheet">

    <!-- Estilo a mensajes de errores -->
    <link rel="stylesheet" href="{{asset('css/estilos.css')}}"></script>


    <!-- Estilo de calendarios -->
    <link rel="stylesheet" href="{{asset('css/tcal.css')}}"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand logo" href="/"><b>RRHHEIQUIA<span>FIAUES</span></b></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav"> 
            @if (Auth::guest())
            <!-- Aqui va el login--> 
            <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Ingresar<b class="caret"></b></a>
                    <ul id="login-dp" class="dropdown-menu">
                        <li>
                            <div class="col-md-12">
                                 <form class="form" name="formu"role="form" method="post" action="{{ url('/login') }}" accept-charset="UTF-8" id="login-nav">
                                 {{ csrf_field() }}
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                             <label class="sr-only" for="usuario_login">Usuario</label>
                                             <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="ejemplo@gmail.com">
                                        </div>
                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                             <label class="sr-only" for="password_login">Contraseña</label>
                                             <input id="password" type="password" class="form-control" name="password" placeholder="********">
                                        </div>
                                        @if ($errors->has('email')||$errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                        @endif
                                        <div class="form-group">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-btn fa-sign-in"></i> Ingresar
                                                </button>
                                        </div>
                                 </form>
                            </div>            
                        </li>            
                    </ul>
             </li>
            <!--Termina el login -->
            @else
            <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ Auth::user()->name }}<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                       
                        <li>
                            <a href="{{URL::action('HomeController@edit',Auth::user()->id)}}"><i class="fa fa-fw fa-gear"></i> Configuracion</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ url('/logout') }}"><i class="fa fa-fw fa-power-off"></i> Cerrar session</a>
                        </li>
                    </ul>
             </li>
            @endif
            </ul>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
            <!--navegacion-->    
                    
                    @if (Auth::guest())
                    <li>
                        <a href="/"><i class="fa fa-fw fa-home"></i> Inicio</a>
                    </li>
                    @else
                        @if (Auth::user()->type=="secret")
                            @include('layouts.navsecret')
                        @endif

                        @if (Auth::user()->type=="admin")
                            @include('layouts.navadmin')
                        @endif

                        @if (Auth::user()->type=="adminsist")
                             @include('layouts.navadminsist')
                        @endif
                    @endif
                </ul>

            </div>
            <!-- /.navbar-collapse -->

        </nav>



        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                 <!--Contenido -->
                 @yield('contenido')

             <!-- Fin Contenido-->
            </div>
            <!-- /.container-fluid -->
             <!--main content end-->
        </div>
        <!-- /#page-wrapper -->
        
        

    </div>
    <!-- /#wrapper -->
    <!--footer start-->
        <div id="page-footer">
            <footer class="site-footer">
                <div class="text-center">
                    <i class="fa fa-copyright"></i> 2016. Todos los derechos reservados - 
                    <a  href="https://www.ues.edu.sv/">Universidad de El Salvador</a>
                    <a href="#" class="go-top">
                        <i class="fa fa-angle-up"></i>
                    </a>
                </div>
            </footer>
        </div>
         <!-- Footer Fin-->


    <!-- jQuery -->
    <script type="text/javascript" src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
    @stack('scripts')

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

    <!-- Plugin jquery dataTables CJavaScript -->
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('js/stacktable.min.js')}}"></script>

    <script > $(document).ready(function(){
    $('#tablaempleado').DataTable();
    });
    </script>

    <script > $(document).ready(function(){
    $('#tablapuesto').DataTable();
    });
    </script>

    <script > $(document).ready(function(){
    $('#tablaexpadmin').DataTable();
    });
    </script>
    <script > $(document).ready(function(){
    $('#tablausers').DataTable();
    });
    </script>
    <script > $(document).ready(function(){
    $('#tablaperfilpuesto').DataTable();
    });
    </script>
    <script > $(document).ready(function(){
    $('#tablaasistencia').DataTable();
    });
    </script>
    <script > $(document).ready(function(){
    $('#tablapermiso').DataTable();
    });
    </script>
    <script > $(document).ready(function(){
    $('#tablaacuerdos').DataTable();
    });
    </script>
    <script > $(document).ready(function(){
    $('#tablaexpacad ').DataTable();
    });
    </script>
    <script > $(document).ready(function(){
    $('#tablaexplabacad ').DataTable();
    });
    </script>
    <script > $(document).ready(function(){
    $('#tablatiempo').DataTable();
    });
    </script>
    //
    <script type=”text/javascript”> $(document).ready(function() {
    $('#tablaexpadmi').stacktable();
    });
    </script>


     <!-- select -->
     <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
     <!-- picker -->
     <script src="{{asset('js/jquery.timepicker.js')}}"></script>
     <script src="{{asset('js/jquery.timepicker.min.js')}}"></script>
    

    <script type="text/javascript" src="{{asset('js/validarJS.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/validarJQue.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/tcal.js')}}"></script>
</body>

</html>