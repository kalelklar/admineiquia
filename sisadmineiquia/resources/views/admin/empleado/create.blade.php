@extends('layouts.admin')
@section('contenido')
 <div class="row">
	<div class="col-lg-12">
	<ol class="breadcrumb">
		<li> <i class="fa fa-home"></i> <a href="/admin/empleado"> Administrar Empleados</a>
		</li>
 		<li class="active">
 		<i class="fa fa-desktop"></i> Crear Empleado</li>
    </ol>
	</div>
 </div>
 
 <div class="row">
	<div class="col-lg-12">
			<h3>Nuevo Empleado</h3>
	</div>
		
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
	
			@endif
 </div>
			
			{!!Form::open(array('url'=>'admin/empleado','method'=>'POST','autocomplete'=>'off','files'=>true, 'id' => 'my-dropzone'))!!}
            {{Form::token()}}
 <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        	<div class="form-group">
				<label for="foto"> Foto Empleado </label>
				<input type="file"  class="form-control" name="foto"  >
			</div>
            <div class="form-group">
            	<label for="primernombre">Primer Nombre</label>
            	<input type="text" name="primernombre" value="{{old('primernombre')}}" class="form-control" placeholder="Primer Nombre..." id="primernombre" onkeyup="corregirPrimerNombre();">
            	<div id="mensaje1" class="errores">Nombre invalido</div>
            </div>
            <div class="form-group">
            	<label for="segundonombre">Segundo Nombre</label>
            	<input type="text" name="segundonombre" value="{{old('segundonombre')}}" class="form-control" placeholder="Segundo Nombre..."
            	id="segundonombre" onkeyup="corregirSegundoNombre();">
            	<div id="mensaje2" class="errores">Nombre invalido</div>
            </div>
            <div class="form-group">
            	<label for="primerapellido">Primer Apellido</label>
            	<input type="text" name="primerapellido" value="{{old('primerapellido')}}" class="form-control" placeholder="Primer Apellido..." id="primerapellido" onkeyup="corregirPrimerApellido();">
            	<div id="mensaje3" class="errores">Apellido invalido</div>
            </div>
            <div class="form-group">
            	<label for="segundoapellido">Segundo Apellido</label>
            	<input type="text" name="segundoapellido" value="{{old('segundoapellido')}}" class="form-control" placeholder="Segundo Apellido..." id="segundoapellido" onkeyup="corregirSegundoApellido();">
            	<div id="mensaje4" class="errores">Apellido invalido</div>
            </div>
		</div>
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">   
			<div class="form-group">
				<label>Documento de Identidad</label>
				<input class="form-control" name="dui"  value="{{old('dui')}}" class="form-control" placeholder="00000000-0" id="dui" onkeyup="corregirDui();">
				<div id="mensaje5" class="errores">DUI invalido</div>
			</div>
			<div class="form-group">
				<label>Numero de Identificacion Tributaria</label>
				<input class="form-control" name="nit" value="{{old('nit')}}" class="form-control" placeholder="0000-000000-000-0" id="nit" onkeyup="corregirNit();">
				<div id="mensaje6" class="errores">NIT invalido</div>
			</div>
			<div class="form-group">
				<label>Numero del Seguro Social</label>
				<input class="form-control" name="isss"  value="{{old('isss')}}" class="form-control" placeholder="000000000" id="isss" onkeyup="corregirIsss();">
				<div id="mensaje7" class="errores">No. ISSS invalido</div>
			</div>
			<div class="form-group">
				<label>Numero de AFP</label>
				<input class="form-control" name="afp" value="{{old('afp')}}" class="form-control" placeholder="000000000000" id="nup" onkeyup="corregirNup();">
				<div id="mensaje8" class="errores">No. AFP invalido</div>
			</div> 
			<div class="form-group">
            	<button class="btn btn-primary" type="submit" id="guardar">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
		</div>            
 </div>
                    {!!Form::close()!!}		

@endsection
