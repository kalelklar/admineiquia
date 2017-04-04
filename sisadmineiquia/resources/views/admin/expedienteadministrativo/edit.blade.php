@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-12">
	<ol class="breadcrumb">
		<li> <i class="fa fa-home"></i> <a href="{{url('/admin/expedienteadministrativo')}}">Expediente Administrativo </a>
		</li>
 		<li class="active">
 		<i class="fa fa-desktop"></i> Editar Expediente Administrativo

    </ol>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
			<h3>Editar Expediente Administrativo de Empleado:
			@foreach ($empleados as $emp)
			{{$emp->nombrecompleto}}
			@endforeach </h3>

	</div>
 </div>
@include('mensajes.errores')
 <div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			@include('mensajes.messages')
			{!!Form::model($expedienteadministrativo,['method'=>'PATCH','route'=>['admin.expedienteadministrativo.update',$expedienteadministrativo->IDEXPEDIENTE]])!!}
            {{Form::token()}}
			<div class="form-group">
				<label>Fecha Apertura Expediente Administrativo</label>
				<input  type="text" name="fechaapertura" value="{{$expedienteadministrativo->FECHAAPERTURA}}" required class="tcal form-control" placeholder="00-00-0000" id="fechaApertura" onkeyup="corregirFecha();">
				<div id="mensajeFechaAper" class="errores">Fecha invalida</div> 
			</div>
      <div class="form-group">
        <label>Codigo Contratacion</label>
        <select name="codigocontrato" required class="form-control" class="form-control selectpicker" placeholder="AC-000-0000" id="codCon" value="{{old('codigocontrato')}}" onkeyup="corregirCodCon();">
                         <option value="{{$expedienteadministrativo->CODIGOCONTRATO}}">{{$expedienteadministrativo->CODIGOCONTRATO}}</option>
                </select>
          <div id="mensajeCodCon" class="errores">Código invalido</div>
      </div>
      <div class="form-group">
        <label>Modalidad de Contratacion</label>
        <input class="form-control" name="modalidadcontratacion" required class="form-control" value="{{$expedienteadministrativo->MODALIDADCONTRATACION}}" placeholder="Tiempo Completo" id="modalidadcontratacion">
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
                  <label>Puesto</label>
                  <select name="idpuesto" required class="form-control" id="idpuestos">
                   @foreach ($puestos as $pues)
                         <option value="{{$pues->idpuesto}}" @if ($expedienteadministrativo->IDPUESTO==$pues->idpuesto)selected="selected" @endif>
                         {{$pues->nombrepuesto}}</option>
                   @endforeach
                  </select>
                  <div id="mensajePue" class="errores">No se ha seleccionado un puesto</div>     
                </div>            
                       <div class="form-group">
                         <label>Tiempo Integral</label>
                         @if($expedienteadministrativo->TIEMPOINTEGRAL=='1')
                         <div class="checkbox">
                          <label>
                         		<input type="checkbox" value="1" name="tiempointegral" id="tiempointegral" checked> Posee
                         	</label>
                          </div>
                          @else
                          <div class="checkbox">
                          <label>
                            <input type="checkbox" value="1" name="tiempointegral" id="tiempointegral"> Posee
                          </label>
                           </div>
                          @endif
                        </div>
                      <div class="form-group">
                     <label for="descripcionadmin">Descripcion</label>
                     <textarea  type="text" name="descripcionadmin" required value="{{old('descripcionadmin')}}" class="form-control"  rows=""  placeholder="Descripcion...">{{$expedienteadministrativo->DESCRIPCIONADMIN}}</textarea>
            </div>
            <div class="form-group align=right">
                  <button class="btn btn-primary" type="submit" id="guardarExp"><i class="glyphicon glyphicon-refresh"></i> Actualizar</button>
                  <a href="{{url('/admin/expedienteadministrativo')}}" class="btn btn-danger" role="button"><i class="glyphicon glyphicon-remove-circle"></i> Cancelar</a>
            </div>   
		</div>
		
                    {!!Form::close()!!}		

</div>
@endsection