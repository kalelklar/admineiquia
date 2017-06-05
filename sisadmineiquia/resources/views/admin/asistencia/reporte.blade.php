@extends('layouts.admin')
@section('contenido')

{!! Form::open(array('url'=>'admin/asistencia/','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}

<div class="row">
    <div class="col-lg-12">
      <ol class="breadcrumb">
        <li><i class="fa fa-home"></i> <a href="{{url('/admin/asistencia')}}"> Gestionar Asistencia</a></li>
        <li class="active"><i class="fa fa-desktop"></i> Reporte de Asistencias</li>
      </ol>
    </div>
 </div>

<div class="panel panel-primary">
  <div class="panel-body">
    
<div class="row">

<div class="col-lg-12 col-md-12 col-sm-8 col-xs-8">
<div class="form-group"> 
	<div class="input-group">
		@include('mensajes.messages')
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
				<h2>Reporte de Asistencias</h2>
			</div>
		</div><br><br>
		
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<label for="fechainicio">Fecha Inicio</label>
          		<input type="text" name="fechainicio" id="fechainicio" placeholder="00/00/0000" required value="{{old('fechaasistencia')}}" class="tcal form-control">
        	</div>
          
        	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
         		<label for="fechafin">Fecha Fin</label>
          		<input type="text" name="fechafin" id="fechafin" placeholder="00/00/0000" required value="{{old('fechaasistencia')}}" class="tcal form-control">
            </div>
		</div><br><br>

		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<span class="input-group-btn">
				<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-save-file"></i> Descargar Reporte</button>
				</span>
			</div>
		</div>

	</div> 
</div>
</div>
</div>
</div>
</div>


{{Form::close()}}
@endsection