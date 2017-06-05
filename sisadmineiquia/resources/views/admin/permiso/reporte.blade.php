//@extends('layouts.admin')
@section('contenido')

{!! Form::open(array('url'=>'admin/permiso/','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <ol class="breadcrumb">
        <li><i class="fa fa-home"></i> <a href="{{url('/admin/permiso')}}"> Gestionar Permisos</a></li>
        <li class="active"><i class="fa fa-desktop"></i> Reporte de Permisos</li>
      </ol>
    </div>
 </div> 

@include('mensajes.messages')

<div class="panel panel-primary">
<div class="panel-body">
    
<div class="row">
<div class="col-lg-4 col-md-8 col-sm-8 col-xs-12">

	<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h2>Reporte de Permisos</h2>
			</div>
	</div><br><br>

	<div class="input-group">
		
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            	<label for="nombre">Ingrese el año:</label>
            	<input type="number" name="year" required value="{{old('year')}}" class="form-control" placeholder="Año...">
        	</div>   
		</div><br><br>

		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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


{{Form::close()}}
@endsection