@extends ('layouts.admin')
@section ('contenido')
<div class="row">
<div class="col-lg-12">
    <ol class="breadcrumb">
        <li><i class="fa fa-home"></i> <a href="{{url('admin/asistencia')}}"> Gestionar Asistencia</a></li>
        <li class="active"><i class="fa fa-desktop"></i>Gestion de Asistencia</li>
    </ol>
</div>

<div class="col-lg-12">
	<label><a href="{{url('admin/asistencia/create')}}" role="button" class="btn btn-success btn-lg"><i class="glyphicon glyphicon-plus"></i> Nueva Asistencia</a></label>
	@include('mensajes.messages')
</div>
</div>

      

<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><br>
    <h2>Listado de Asistencias</h2>
</div><br><br>

<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
<div class="table-toolbar">
<div class="btn-group pull-right">
	<button data-toggle="dropdown" class="btn btn-primary" class="btn dropdown-toggle"> <i class="glyphicon glyphicon-save-file"></i> Reporte de Asistencia <span class="caret"></span> </button>
	<ul class="dropdown-menu">
		<li><a href="{{url('admin/asistencia/reporte/1')}}">Enero</a></li>
		<li><a href="{{url('admin/asistencia/reporte/2')}}">Febrero</a></li>
		<li><a href="{{url('admin/asistencia/reporte/3')}}">Marzo</a></li>
		<li><a href="{{url('admin/asistencia/reporte/4')}}">Abril</a></li>
		<li><a href="{{url('admin/asistencia/reporte/5')}}">Mayo</a></li>
		<li><a href="{{url('admin/asistencia/reporte/6')}}">Junio</a></li>
		<li><a href="{{url('admin/asistencia/reporte/7')}}">Julio</a></li>
		<li><a href="{{url('admin/asistencia/reporte/8')}}">Agosto</a></li>
		<li><a href="{{url('admin/asistencia/reporte/9')}}">Septiembre</a></li>
		<li><a href="{{url('admin/asistencia/reporte/10')}}">Octubre</a></li>
		<li><a href="{{url('admin/asistencia/reporte/11')}}">Noviembre</a></li>
		<li><a href="{{url('admin/asistencia/reporte/12')}}">Diciembre</a></li>
	</ul>
</div>
</div>
</div>

	<br><br>
</div>
</div>

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><br>
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover" id="tablaasistencia" class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
				<thead style="background-color: #A9D0F5">
					<th>Id</th>
					<th>Fecha</th>
					<th>Turno</th>
					<th>Opciones</th>
				</thead>
               @foreach ($asistencias as $asis)
				<tr>
					<td>{{ $asis->idasistencia}}</td>
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
