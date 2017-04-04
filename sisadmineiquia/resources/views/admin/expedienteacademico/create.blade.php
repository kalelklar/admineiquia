@extends('layouts.admin')
@section('contenido')
<div class="row">
    <div class="col-lg-12">
    <ol class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="{{url('/admin/expedienteacademico')}}">Administrar Expediente Academico</a>
        </li>
 		<li class="active">
 		<i class="fa fa-desktop"></i> Nuevo Expediente Academico</li>
    </ol>
	</div>
 </div>
 <div class="row">
	<div class="col-lg-12">
			<h3> Expediente Academico de Empleado</h3>

	</div>
 </div>
 @include('mensajes.errores')
 <div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			@include('mensajes.messages')
			{!!Form::open(array('url'=>'admin/expedienteacademico','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}    
			<div class="form-group">
				<label>Fecha Apertura Expediente Academico</label>
				<input  type="text" name="fechaaperturaexpacad" value="{{old('fechaaperturaexpacad')}}" class="tcal form-control" placeholder="00-00-0000" id="fechaaperturaexpacad" onkeyup="corregirFecha();">
				<div id="mensajeFechaAper" class="errores">Fecha invalida</div> 
			</div>
			
			<div class="form-group">
                  <label>Empleado</label>
                  <select name="idempleado" class="form-control" id="idempleados">
                   @foreach ($empleados as $emp)
                         <option value="{{$emp->idempleado}}">{{$emp->nombrecompleto}}</option>
                   @endforeach
                  </select>  
                  <div id="mensajeEmp" class="errores">No se ha seleccionado un empleado</div>      
			</div>

			<div class="form-group">
            	<label for="nombreinstitucion">Nombre Institucion</label>
            	<input type="text" name="nombreinstitucion" value="{{old('nombreinstitucion')}}" class="form-control" placeholder="Nombre Institucion..." id="nombreinstitucion" onkeyup="nombreinstitucion();" >
            	<div id="mensaje1" class="errores">Nombre invalido</div>
            </div>

            <div class="form-group">
				<label>Año de Titulacion</label>
				<input  type="text" name="anotitulacion" class="tcal form-control" value="{{old('anotitulacion')}}" placeholder="00-00-0000" id="anotitulacion" onkeyup="corregirFecha();">
				<div id="mensajeFechaAper" class="errores">Fecha invalida</div> 
			</div>
            <div class="form-group">
                <label for="tituloobtenido">Titulo Obtenido</label>
                <input type="text" name="tituloobtenido" value="{{old('tituloobtenido')}}" class="form-control" placeholder="Titulo Obtenido..." id="tituloobtenido" onkeyup="tituloobtenido();">
                <div id="mensaje1" class="errores">Nombre invalido</div>
            </div>
        </div>   
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
            	<label for="maestria">Maestria</label>
            	<input type="text" name="maestria" value="{{old('maestria')}}" class="form-control" placeholder="Maestrias..." id="maestria">
            </div>
            <div class="form-group">
            	<label for="direccioninstitucion">Direccion Institucion </label>
            	<input type="text" name="direccioninstitucion" value="{{old('direccioninstitucion')}}" class="form-control" placeholder="Direccion Institucion..." id="direccioninstitucion" ">
            </div>
            <div class="form-group">
                <label>Descripcion Academica</label>
                <textarea  name="descripcionacademica" id="descripcionacademica" class="form-control"  rows="3" placeholder="Descripcion Academica">{{old('descripcionacademica')}}</textarea>
            </div>
            <div class="form-group">
                <label>Post-Grados</label>
                <textarea  name="postgrados" id="postgrados" class="form-control"  rows="3" placeholder="postgrado 1, postgrado 2">{{old('postgrados')}}</textarea>
            </div>
            <div class="form-group" align=right>
            	<button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button>
            	<button class="btn btn-danger" type="reset"><i class="glyphicon glyphicon-remove-circle"></i> Cancelar</button>
            </div>

		</div>

		
                    {!!Form::close()!!}		

</div>

@endsection