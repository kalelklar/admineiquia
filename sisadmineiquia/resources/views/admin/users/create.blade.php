@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-12">
	<ol class="breadcrumb">
		<li> <i class="fa fa-home"></i> <a href="{{url('admin/users')}}""> Administrar Usuarios</a>
		</li>
 		<li class="active">
 		<i class="fa fa-desktop"></i> Crear Usuarios</li>
    </ol>
	</div>
 </div>
 <div class="row">
	<div class="col-lg-12">
			<h3>Nuevo Usuario</h3>
	</div>
 </div>
 <div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">		
			{!!Form::open(array('url'=>'admin/users','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            	<label for="name" class="col-md-6 control-label">Nombre</label>

            	<div>
            		<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Digite un nombre">

            		@if ($errors->has('name'))
            		<span class="help-block">
            			<strong>{{ $errors->first('name') }}</strong>
            		</span>
            		@endif
            	</div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            	<label for="email" class="col-md-6 control-label" >Correo Electronico</label>

            	<div>
            		<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="ejemplo@gmail.com">

            		@if ($errors->has('email'))
            		<span class="help-block">
            			<strong>{{ $errors->first('email') }}</strong>
            		</span>
            		@endif
            	</div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            	<label for="password" class="col-md-6 control-label">Contraseña</label>

            	<div>
            		<input id="password" type="password" class="form-control" name="password" placeholder="*********">

            		@if ($errors->has('password'))
            		<span class="help-block">
            			<strong>{{ $errors->first('password') }}</strong>
            		</span>
            		@endif
            	</div>
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            	<label for="password-confirm" class="col-md-6 control-label">Confirmar Contraseña</label>

            	<div>
            		<input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="*********">

            		@if ($errors->has('password_confirmation'))
            		<span class="help-block">
            			<strong>{{ $errors->first('password_confirmation') }}</strong>
            		</span>
            		@endif
            	</div>
            </div>
            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
            	<label for="tipo" class="col-md-6 control-label">Tipo de Usuario</label>

            	<div>
            		{!! Form::select('type',[''=>'Seleccione un tipo de usuario','adminsist'=>'Administrador del Sistema','admin'=>'Administrador','secret'=>'Secretaria'],null,['class'=>'form-control'])!!}
            	</div>
            		@if ($errors->has('type'))
            		<span class="help-block">
            			<strong>{{ $errors->first('type') }}</strong>
            		</span>
            		@endif
            </div>
            <div class="form-group">
            	<div class="col-md-6 col-md-offset-4">
            		<button type="submit" class="btn btn-primary">
            			<i class="fa fa-btn fa-user"></i> Registrar
            		</button>
            	</div>
            </div>
            </div>    
		</div>
                    {!!Form::close()!!}		

</div>
@endsection
