@extends ('layouts.admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><br>
    	<ol class="breadcrumb">
        	<li><i class="fa fa-home"></i> <a href="{{url('admin/asistencia')}}"> Gestionar Asistencia</a></li>
        	<li class="active"><i class="fa fa-desktop"></i>Gestion de Asistencia</li>
    	</ol>
	</div>
</div>
 
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<label><a href="{{url('admin/asistencia/create')}}" role="button" class="btn btn-success btn-lg"><i class="glyphicon glyphicon-plus"></i> Nueva Asistencia</a></label>
		<label><a href="{{url('admin/asistencia/reporte')}}" role="button" class="btn btn-success btn-lg"><i class="glyphicon glyphicon-plus"></i> Reporte</a></label>
	</div>
</div><br>

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
    	 @include('mensajes.messages')  
	</div>


	<div class="col-lg-12 col-md-6 col-sm-6 col-xs-12"><br>
         <h2>Listado de Asistencias</h2>
	</div>
	
</div> 

{!! Form::open(array('url'=>'admin/asistencia','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
{{Form::close()}}

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><br>
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover" id="tablaasistencia" >
				<thead style="background-color: #A9D0F5">
					<th>Fecha</th>
					<th>Turno</th>
					<th>Opciones</th>
				</thead>
               @foreach ($asistencias as $asis)
				<tr>
					<td>{{ $asis->fechaasistencia}}</td>
                    @if($asis->turno=='0')
					   <td>Mañana</td>
                      @else 
                       <td>Tarde</td>
                    @endif
					<td>
                        <a href="{{URL::action('AsistenciaController@edit',$asis->idasistencia)}}"><button class="btn btn-xs btn-primary"><i class="glyphicon  glyphicon-edit"></i> Editar</button></a>
                        <a href="" data-target="#modal-delete-{{$asis->idasistencia}}" data-toggle="modal"><button class="btn btn-xs btn-danger"> <i class="glyphicon glyphicon-remove-circle"></i> Eliminar</button></a>
                        <a href="{{URL::action('AsistenciaController@show',$asis->idasistencia)}}"><button class="btn btn-xs btn-info"> <i class="glyphicon glyphicon-list-alt"></i> Detalles</button></a>
					</td>
				</tr>
				@include('admin.asistencia.modal')
				@endforeach
			</table>
		</div>
	</div>
</div>

@endsection
