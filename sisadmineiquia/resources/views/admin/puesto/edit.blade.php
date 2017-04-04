@extends('layouts.admin')
@section('contenido')
<div class="row">
  <div class="col-lg-12">
  <ol class="breadcrumb">
    <li> <i class="fa fa-home"></i> <a href="{{url('/admin/puesto')}}"> Gestionar Puesto</a>
    </li>
    <li class="active">
    <i class="fa fa-desktop"></i> Editar Puesto</li>
    </ol>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
      <h3>Editar Puesto</h3>
  </div>
</div>
@include('mensajes.errores')
      <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
      @include('mensajes.messages')
			{!!Form::model($puesto,['method'=>'PATCH','route'=>['admin.puesto.update',$puesto->IDPUESTO]])!!}
            {{Form::token()}}     

            <div class="form-group">
            	<label for="nombre">Nombre</label>
            	<input type="text" name="nombrepuesto" required value="{{$puesto->NOMBREPUESTO}}" class="form-control">
            </div>


            <div class="form-group">
                  <label> Departamento</label>
                  <select name="iddepartamento" required  class="form-control">
                   @foreach ($departamentos as $dep)
                         @if ($dep->iddepartamento==$puesto->IDDEPARTAMENTO)
                         <option value="{{$dep->iddepartamento}}" selected>{{$dep->nombredepartamento}}</option>
                         @else
                          <option value="{{$dep->iddepartamento}}">{{$dep->nombredepartamento}}</option>
                         @endif
                   @endforeach
                  </select>     
            </div>

            <div class="form-group">
                  <label> Perfil del Puesto</label>
                  <select name="idperfilpuesto" required  class="form-control">
                   @foreach ($perfil as $per)
                         @if ($per->idperfilpuesto==$puesto->IDPERFILPUESTO)
                         <option value="{{$per->idperfilpuesto}}" selected>{{$per->profesion}}</option>
                         @else
                          <option value="{{$per->idperfilpuesto}}">{{$per->profesion}}</option>
                         @endif
                   @endforeach
                  </select>     
            </div>
            
            <div class="form-group">
            	<label for="descripcion">Descripción</label>
            	<input type="text" name="descripcionpuesto" required value="{{$puesto->DESCRIPCIONPUESTO}}" class="form-control" placeholder="Descripción Puesto...">
            </div>
            <div class="form-group">
            	<label for="salario">Salario</label>
            	<input type="text" name="salariopuesto" required value="{{$puesto->SALARIOPUESTO}}" class="form-control">
            </div>

            <div class="form-group">
                  <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-refresh"></i> Actualizar</button>
                  <a href="{{url('/admin/puesto')}}" class="btn btn-danger" role="button"><i class="glyphicon glyphicon-remove-circle"></i> Cancelar</a>
            </div>

			{!!Form::close()!!}		
            
		</div>
	</div>
@endsection