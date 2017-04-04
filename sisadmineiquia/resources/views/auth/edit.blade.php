@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-12">
	<ol class="breadcrumb">
		<li> <i class="fa fa-home"></i> <a href="{{url('/')}}"> Inicio</a>
		</li>
 		<li class="active">
 		<i class="fa fa-desktop"></i> Actualizar Datos</li>
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
            @include('mensajes.messages')		
		{!!Form::model($user,['method'=>'PATCH','route'=>['home.update',$user->id]])!!}
            {{Form::token()}} 
             <div class="form-group{{ $errors->has('passwordactual') ? ' has-error' : '' }}">
                  <label for="passwordactual" class="col-md-6 control-label">Contraseña Actual</label>

                  <div>
                        <input id="passwordactual" type="password" class="form-control" name="passwordactual" placeholder="*******">

                        @if ($errors->has('passwordactual'))
                        <span class="help-block">
                              <strong>{{ $errors->first('passwordactual') }}</strong>
                        </span>
                        @endif
                  </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            	<label for="password" class="col-md-6 control-label">Nuevo Contraseña</label>

            	<div>
            		<input id="password" type="password" class="form-control" name="password" placeholder="*******">

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
            		<input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="*******">

            		@if ($errors->has('password_confirmation'))
            		<span class="help-block">
            			<strong>{{ $errors->first('password_confirmation') }}</strong>
            		</span>
            		@endif
            	</div>
            </div>
            <div class="form-group">
            	<div class="col-md-6 col-md-offset-4">
            		<button type="submit" class="btn btn-primary">
            			<i class="fa fa-btn fa-user"></i> Actualizar
            		</button>
                        <a href="{{url('/')}}" class="btn btn-danger" role="button"><i class="glyphicon glyphicon-remove-circle"></i> Cancelar</a>
            	</div>
            </div>
            
            </div>    
		</div>
                    {!!Form::close()!!}		

</div>
@endsection
