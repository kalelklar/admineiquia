@extends('layouts.admin')
@section('contenido')
<div class="row">
  <div class="col-lg-12">
  <ol class="breadcrumb">
    <li> <i class="fa fa-home"></i> <a href="{{url('/admin/puesto')}}"> Gestionar Puesto</a>
    </li>
    <li class="active">
    <i class="fa fa-desktop"></i> Crear Puesto</li>
    </ol>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
      <h3>Nuevo Puesto</h3>
  </div>
 </div>
 
@include('mensajes.errores')
@include('mensajes.messages') 
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    
			{!!Form::open(array('url'=>'admin/puesto','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}   

            <div class="form-group">
            	<label for="nombre">Nombre</label>
            	<input type="text" name="nombrepuesto" required value="{{old('nombrepuesto')}}" class="form-control" placeholder="Nombre Puesto...">
            </div>

            <div class="form-group">
                  <label> Departamento</label>
                  <select name="iddepartamento" required  class="form-control">
                  <option value="">Seleccionar Departamento...</option>
                   @foreach ($departamentos as $dep) 
                         <option value="{{$dep->iddepartamento}}">{{$dep->nombredepartamento}}</option>
                   @endforeach
                  </select>     
            </div>

            <div class="form-group">
                  <label> Perfil del Puesto</label>
                  <select name="idperfilpuesto" required  class="form-control">
                   <option value="">Seleccionar Perfil...</option>
                   @foreach ($perfil as $per)
                         <option value="{{$per->idperfilpuesto}}">{{$per->profesion}}</option>
                   @endforeach
                  </select>     
            </div>

            <div class="form-group">
            	<label for="descripcion">Descripción</label>
            	<input type="text" name="descripcionpuesto" required value="{{old('descripcionpuesto')}}" class="form-control" placeholder="Descripción Puesto...">
            </div>
            
            <div class="form-group">
            	<label for="salario">Salario</label>
            	<input type="text" name="salariopuesto" required value="{{old('salariopuesto')}}" class="form-control" placeholder="Salario Puesto...">
            </div>

            <div class="form-group">
            	<button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button>
            	<a href="{{url('admin/puesto')}}" class="btn btn-danger" role="button"><i class="glyphicon glyphicon-remove-circle"></i> Cancelar</a>
            </div>
			{!!Form::close()!!}		     
		</div>
	</div>
@endsection