@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Puestos <a href="puesto/create"><button class="btn btn-success">Nuevo</button></a></h3>
		<div>

	    </div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover" id="tablapuesto">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Descripción</th>
					<th>Salario</th>
					<th>Departamento</th>
					<th>Opciones</th>
				</thead>
               @foreach ($puestos as $pues)
				<tr>
					<td>{{ $pues->idpuesto}}</td>
					<td>{{ $pues->nombrepuesto}}</td>
					<td>{{ $pues->descripcionpuesto}}</td>
				    <td>{{ $pues->salariopuesto}}</td>
				    <td>{{ $pues->departamento}}</td>
					<td>
						<a href="{{URL::action('PuestoController@edit',$pues->idpuesto)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$pues->idpuesto}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('admin.puesto.modal')
				@endforeach
			</table>
		</div>
		{{$puestos->render()}}
	</div>
</div>

@endsection