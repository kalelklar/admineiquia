@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-12">
	<ol class="breadcrumb">
		<li> <i class="fa fa-home"></i> <a href="{{url('admin/users')}}"> Administrar Usuario</a>
		</li>
 		<li class="active">
 		<i class="fa fa-desktop"></i> Actualizar Usuario</li>
    </ol>
	</div>
 </div>
 <div class="row">
	<div class="col-lg-12">
			<h3>Usuario: {{$user->name}}</h3>
	</div>
 </div>
 <div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">		
		{!!Form::model($user,['method'=>'PATCH','route'=>['admin.users.update',$user->id]])!!}
            {{Form::token()}} 
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            	<label for="name" class="col-md-6 control-label">Nombre</label>

            	<div>
            		<input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" disabled>

            		@if ($errors->has('name'))
            		<span class="help-block">
            			<strong>{{ $errors->first('name') }}</strong>
            		</span>
            		@endif
            	</div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            	<label for="email" class="col-md-6 control-label">Correo Electronico</label>

            	<div>
            		<input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}"
                        disabled>

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
            		<input id="password" type="password" class="form-control" name="password" >

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
            		<input id="password-confirm" type="password" class="form-control" name="password_confirmation">

            		@if ($errors->has('password_confirmation'))
            		<span class="help-block">
            			<strong>{{ $errors->first('password_confirmation') }}</strong>
            		</span>
            		@endif
            	</div>
            </div>
            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
            	<label for="tipo" class="col-md-6 control-label">Tipo</label>

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
            			<i class="glyphicon glyphicon-refresh"></i> Actualizar
            		</button>
                        <a href="{{url('admin/users')}}"" class="btn btn-danger" role="button"><i class="glyphicon glyphicon-remove-circle"></i> Cancelar</a>
            	</div>
            </div>
            
            </div>    
		</div>
                    {!!Form::close()!!}		

</div>
@endsection
