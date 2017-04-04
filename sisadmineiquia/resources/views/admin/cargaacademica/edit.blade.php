@extends('layouts.admin')
@section('contenido')
<div class="row">
<div class="row">
	<div class="col-lg-12">
	<ol class="breadcrumb">
		<li> <i class="fa fa-home"></i> <a href="{{url('/admin/cargaacademica')}}">Administrar Carga Academica</a>
		</li>
 		<li class="active">
 		<i class="fa fa-desktop"></i> Editar Carga Academica</li>
    </ol>
	</div>
 </div>
 <div class="row">
	<div class="col-lg-12">
			<h3> Editar Carga Academica </h3>
	</div>
 </div>
 @include('mensajes.errores')
 <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      @include('mensajes.messages')
      {!!Form::model($cargaacademica,['method'=>'PATCH','route'=>['admin.cargaacademica.update',$cargaacademica->IDASIGNACIONACAD],'files'=>'true'])!!}
            {{Form::token()}} 

            <div class="form-group">
                  <label>Empleado</label>
                  <select name="idempleado" class="form-control" id="idempleados">
                   @foreach ($empleados as $emp)
                         <option value="{{$emp->idexpedienteacadem}}">{{$emp->nombrecompleto}}</option>

                   @endforeach
                  </select>  
                  <div id="mensajeEmp" class="errores">No se ha seleccionado un empleado</div>      
			     </div>  
			
	           <div class="form-group">
                  <label>Nombre de Ciclo</label>
                  <select name="idciclo" class="form-control" id="idciclo">
                   @foreach ($empleados as $emp)
                   @foreach ($ciclos as $ciclo)
                   <option value="{{$ciclo->idciclo}}" @if ($ciclo->idciclo==$emp->idciclo)selected="selected" @endif>{{$ciclo->nombreciclo}}</option>
                   @endforeach
                   @endforeach
                  </select>  
              </div>


			      <div class="form-group">
              <label for="anocarga">Año</label>
              <select name="anocarga" class="form-control" id="anocarga">
                @foreach ($empleados as $emp)
                @for($i=date('o'); $i>=1910; $i--)
                <option value="{{$i}}" @if ($i == $emp->ano) selected @endif>{{$i}}</option>
                @endfor
                @endforeach
                </select>
            </div>

            <div class="form-group">
            	<label for="codigoasignatura">Codigo Asignatura</label>
            	<input type="text" name="codigoasignatura" value="{{$cargaacademica->CODASIGNATURA}}" class="form-control" placeholder="Codigo Asignatura..." id="codigoasignatura" >
            	<div id="mensaje1" class="errores">Codigo Invalido</div>
            </div>

             <div class="form-group">
            	<label for="nombreasignatura">Nombre Asignatura</label>
            	<input type="text" name="nombreasignatura" value="{{$cargaacademica->NOMBREASIGNATURA}}" class="form-control" placeholder="Nombre Asignatura..." id="nombreasignatura" onkeyup="corregirNombreAsignatura();">
            	<div id="mensaje1" class="errores">Nombre Invalido</div>
            </div>

            
			 
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

		<div class="form-group">
            	<label for="grupoteorico">Grupo Teorico</label>
            	<input type="text" name="grupoteorico" value="{{$cargaacademica->GTEORICO}}" class="form-control" placeholder="1,2,3,4,5..." id="grupoteorico" >
            	<div id="mensaje1" class="errores">Nombre invalido</div>
            </div>

            <div class="form-group">
            	<label for="grupodiscusion">Grupo Discusion</label>
            	<input type="text" name="grupodiscusion" value="{{$cargaacademica->GDISCUSION}}" class="form-control" placeholder="1,2,3,4,5..." id="grupodiscusion" >
            	<div id="mensaje1" class="errores">Grupo invalido</div>
            </div>

            <div class="form-group">
            	<label for="grupolaboratorio">Grupo Laboratorio</label>
            	<input type="text" name="grupolaboratorio" value="{{$cargaacademica->GLABORATORIO}}" class="form-control" placeholder="1,2,3,4,5..." id="grupolaboratorio" >
            	<div id="mensaje1" class="errores">Grupo invalido</div>
            </div>


            <div class="form-group">
            	<label for="tiempototal">Tiempo Total</label>
            	<input type="text" name="tiempototal" value="{{$cargaacademica->TIEMPOTOTAL}}" class="form-control" placeholder="Tiempo Total..." id="tiempototal" >
            	<div id="mensaje1" class="errores">Tiempo invalido</div>
            </div>
            <div class="form-group">
                <label>Responsabilidad Administrativas</label>
                <textarea  name="responsabilidadadministrativa" id="responsabilidadadministrativa" class="form-control"  rows="3" placeholder="Responsabilidad  Administrativas">{{$cargaacademica->RESPONSABILIDADADMIN}}</textarea>
            </div>
            <div class="form-group">
                  <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-refresh"></i> Actualizar</button>
                  <a href="{{url('/admin/cargaacademica')}}" class="btn btn-danger" role="button"><i class="glyphicon glyphicon-remove-circle"></i> Cancelar</a>
            </div>
		</div>
                    {!!Form::close()!!}		

</div>

@endsection