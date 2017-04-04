@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li>
				<i class="fa fa-home"></i> <a href="{{url('/admin/experiencialaboralacademica')}}"> Administrar Experiencia Academica</a>
			</li>
			<li class="active">
				<i class="fa fa-desktop"></i>
				Gestion Experiencia Laboral Academica
			</li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
			<h3>Nuevo Experiencia Laboral</h3>
	</div>		
</div>
 @include('mensajes.errores')
 <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            @include('mensajes.messages')
			{!!Form::open(array('url'=>'admin/experiencialaboralacademica','method'=>'POST','autocomplete'=>'off','files'=>true, 'id' => 'my-dropzone'))!!}
            {{Form::token()}}
            <div class="form-group">
                  <label>Empleado</label>
                  <select name="idexpedienteacadem" class="form-control" id="idexpedienteacadem">
                   @foreach ($empleados as $emp)
                         <option value="{{$emp->idexpedienteacadem}}">{{$emp->nombrecompleto}}</option>
                   @endforeach
                  </select>     
            </div> 
            <div class="form-group">
            	<label for="nombreinstitucionexplabacad">Nombre de la Institucion</label>
            	<input type="text" name="nombreinstitucionexplabacad" value="{{old('nombreinstitucionexplabacad')}}" required class="form-control" placeholder="Institucion..." id="nombreinstitucionexplabacad" ">
            </div>
            <div class="form-group">
                <label>Fecha de Inicio:</label>
                <input  type="text" name="fechainicioexplabacad" id="fechainicioexplabacad" required class="tcal form-control" value="{{old('fechainicioexplabacad')}}" placeholder="00-00-0000" id="fechainicioexplabacad">
            </div>
            <div class="form-group">
                <label>Fecha de Fin:</label>
                <input type='text' name="fechafinalizacionexplabacad" id="fechafinalizacionexplabacad" required class="tcal form-control" value="{{old('fechafinalizacionexplabacad')}}" placeholder="00-00-0000" id="fechafinalizacionexplabacad"/>
            </div>
            <div class="form-group">
                     <label for="descripcionexplab">Descripcion Experiencia</label>
                     <textarea  type="text" name="descripcionexplab" value="{{old('descripcionexplab')}}" class="form-control"  rows=""  placeholder="Descripcion..."></textarea>
            </div>
            <div class="form-group">
            	<button class="btn btn-primary" type="submit" id="guardar"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button>
            	<button class="btn btn-danger" type="reset"><i class="glyphicon glyphicon-remove-circle"></i> Cancelar</button>
            </div>
		</div> 
			{!!Form::close()!!}	        
</div>                  
@endsection
