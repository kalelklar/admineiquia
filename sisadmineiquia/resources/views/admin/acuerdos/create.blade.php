@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-12">
	<ol class="breadcrumb">
		<li> <i class="fa fa-home"></i> <a href="{{url('admin/acuerdos')}}"> Administrar Acuerdos Administrativos</a>
		</li>
 		<li class="active">
 		<i class="fa fa-desktop"></i> Crear Acuerdo Administrativo</li>
    </ol>
	</div>
 </div>
 <div class="row">
	<div class="col-lg-12">
			<h3>Nuevo Acuerdo Administrativo</h3>
	</div>
 </div>
@include('mensajes.errores')
 <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      @include('mensajes.messages')
			{!!Form::open(array('url'=>'admin/acuerdos','method'=>'POST','autocomplete'=>'off','files'=>true,'id' => 'my-dropzone'))!!}
            {{Form::token()}}
            <div class="form-group">
            	<label for="idacuerdo">Código</label>
            	<input type="text" name="idacuerdo" class="form-control" required value="{{old('idacuerdo')}}" placeholder="AC-000-0000" id="codAcuerdo" onkeyup="corregirCodAcuerdo();">
            </div>
            <div class="form-group">
				<label for="foto">Documento</label>
				<input type="file"  class="form-control" name="archivoacuerdo">
			</div>
            <div class="form-group">
            	<label for="idempleado">Empleado</label>
            	<select name="idempleado" class="form-control" id="idempleado">
	            	@foreach ($empleado as $emp)
	                        <option value="{{$emp->idempleado}}">{{$emp->nombrecompleto}}</option>
	                @endforeach
            	</select>
            </div>
            <div class="form-group">
            	<label for="motivoacuerdo">Motivo</label>
            	<input type="text" name="motivoacuerdo" class="form-control" required value="{{old('motivoacuerdo')}}" placeholder="Escribir motivo..." id="motivoAcuerdo" onkeyup="corregirMotivoAcuerdo();">
            </div>
            <div class="form-group">
				<label for="descripcionacuerdo">Descripción</label>
                <textarea  name="descripcionacuerdo" id="descripcionAcuerdo" class="form-control"  rows="3" placeholder="Escribir descripción" onkeyup="corregirDescripcionAcuerdo();">{{old('descripcionacuerdo')}}</textarea>
			</div>
            <div class="form-group">
				<label for="fechaacuerdo">Fecha</label>
				<input name="fechaacuerdo" class="tcal form-control" required value="{{old('fechaacuerdo')}}" placeholder="00-00-0000" id="fechaAcuerdo" onkeyup="corregirFechaAcuerdo();">
			</div>
            <div class="form-group">
            	<button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-floppy-disk"></i>  Guardar</button>
            	<a href="{{url('/admin/acuerdos')}}" class="btn btn-danger" role="button"><i class="glyphicon glyphicon-remove-circle"></i> Cancelar</a>
            </div>
		</div>

                    {!!Form::close()!!}		

</div>
@endsection
