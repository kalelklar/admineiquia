@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-12">
	<ol class="breadcrumb">
		<li> <i class="fa fa-home"></i> <a href="{{url('/admin/expedienteacademico')}}">Administrar Expediente Academico</a>
		</li>
 		<li class="active">
 		<i class="fa fa-desktop"></i> Editar Expediente Academico

    </ol>
	</div>
 </div>
 <div class="row">
	<div class="col-lg-12">
			<h3>Editar Expediente Academico de Empleado:
			@foreach ($empleados as $emp)
			{{$emp->nombrecompleto}}
			@endforeach </h3>

	</div>
 </div>
 @include('mensajes.errores')
 <div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			@include('mensajes.messages')
			{!!Form::model($expedienteacademico,['method'=>'PATCH','route'=>['admin.expedienteacademico.update',$expedienteacademico->IDEXPEDIENTEACADEM]])!!}
            {{Form::token()}}
      <div class="form-group">
				<label>Fecha Apertura Expediente Academico</label>
				<input  type="text" name="fechaaperturaexpacad" value="{{$expedienteacademico->FECHAAPERTURAEXPACAD}}" class="tcal form-control" required placeholder="00/00/0000" id="fechaaperturaexpacad">
				<div id="mensajeFechaAper" class="errores">Fecha invalida</div> 
			</div>
			
			<div class="form-group">
                  <label>Empleado</label>
                  <select name="idempleado" required class="form-control" id="idempleados">
                   @foreach ($empleados as $emp)
                         <option value="{{$emp->idempleado}}">{{$emp->nombrecompleto}}</option>
                   @endforeach
                  </select>  
                  <div id="mensajeEmp" class="errores">No se ha seleccionado un empleado</div>      
			</div>

      <div class="form-group">
       <label for="nombreinstitucion">Nombre Institucion</label>
       <input type="text" name="nombreinstitucion" value="{{$expedienteacademico->NOMBREINSTITUCION}}" required class="form-control" placeholder="Nombre Institucion..." id="nombreinstitucion" >
       <div id="mensaje1" class="errores">Nombre invalido</div>
     </div>

     <div class="form-group">
      <label>Año de Titulacion</label>
      <input  type="text" name="anotitulacion" required class="tcal form-control" value="{{$expedienteacademico->ANOTITULACION}}" placeholder="00-00-0000" id="anotitulacion" >
      <div id="mensajeFechaAper" class="errores">Fecha invalida</div> 
    </div>
    <div class="form-group">
      <label for="tituloobtenido">Titulo Obtenido</label>
      <input type="text" name="tituloobtenido" value="{{$expedienteacademico->TITULOOBTENIDO}}" required class="form-control" placeholder="Titulo Obtenido..." id="tituloobtenido" >
      <div id="mensaje1" class="errores">Nombre invalido</div>
    </div>

    </div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
            	<label for="maestria">Maestria</label>
            	<input type="text" name="maestria" value="{{$expedienteacademico->TITULOESTUDIO}}" required  class="form-control" placeholder="Maestria..." id="maestria" >
            	<div id="mensaje1" class="errores">Nombre invalido</div>
            </div>

            <div class="form-group">
            	<label for="direccioninstitucion">Direccion Institucion </label>
            	<input type="text" name="direccioninstitucion" value="{{$expedienteacademico->DIRECCIONINSTITUCION}}" required class="form-control" placeholder="Direccion Institucion..." id="direccioninstitucion" >
            	<div id="mensaje1" class="errores">Direccion invalida</div>
            </div>

            <div class="form-group">
                <label>Descripcion Academica</label>
                <textarea  name="descripcionacademica" id="descripcionacademica" required  class="form-control"  rows="3" placeholder="Descripcion Academica">{{$expedienteacademico->DESCRIPCIONACADEMICA}}</textarea>
            </div>
            <div class="form-group">
                <label>Post-Grados</label>
                <textarea  name="postgrados" id="postgrados" class="form-control"  rows="3" placeholder="postgrado 1, postgrado 2">{{$expedienteacademico->POSTGRADOS}}</textarea>
            </div>
            <div class="form-group">
                  <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-refresh"></i> Actualizar</button>
                  <a href="{{url('/admin/expedienteacademico')}}" class="btn btn-danger" role="button"><i class="glyphicon glyphicon-remove-circle"></i> Cancelar</a>
            </div>
		</div>
                    {!!Form::close()!!}		

</div>

@endsection