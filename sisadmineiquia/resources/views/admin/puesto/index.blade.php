@extends ('layouts.admin')
@section ('contenido')
<div class="row">
   <div class="col-lg-12">
       <ol class="breadcrumb">
          <li><i class="fa fa-home"></i> <a href="{{url('/admin/puesto')}}"> Gestionar Puesto</a></li>
          <li class="active"><i class="fa fa-desktop"></i> Administrar Puesto</li>
       </ol>
    </div>
</div>
               
  <div class="col-lg-12">
  	 <label><a href="{{url('/admin/puesto/create')}}" class="btn btn-success btn-lg" role="button"><i class="fa fa-plus"></i> Nuevo Puesto</a></label>
  	  
  </div>
  <div class="col-lg-12">
     @include('mensajes.messages')
  </div>
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h2>Listado de Puestos</h2>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover" id="tablapuesto">
				<thead style="background-color: #A9D0F5">
					<th>Nombre</th>
					<th>Departamento</th>
					<th>Descripción</th>
					<th>Profesion</th>
					<th>Reporta a:</th>
					<th>Opciones</th>
				</thead>
               @foreach ($puestos as $pues)
				<tr>
					<td>{{ $pues->nombrepuesto}}</td>
					<td>{{ $pues->departamento}}</td>
					<td>{{ $pues->descripcionpuesto}}</td>
				    <td>{{ $pues->profesion}}</td>
				    <td>{{ $pues->reporta}}</td>
					<td>
						<a href="{{URL::action('PuestoController@edit',$pues->idpuesto)}}"><button class="btn btn-xs btn-primary"><i class="glyphicon  glyphicon-edit"></i> Editar</button></a>
                        <a href="" data-target="#modal-delete-{{$pues->idpuesto}}" data-toggle="modal"><button class="btn btn-xs btn-danger"><i class="fa fa-remove"></i> Eliminar</button></a>
                        <a href="{{URL::action('PuestoController@show',$pues->idpuesto)}}"><button class="btn btn-xs btn-info"><i class="glyphicon glyphicon-list-alt"></i> Detalle</button></a>
					</td>
				</tr>
				@include('admin.puesto.modal')
				@endforeach
			</table>
		</div>
	</div>
</div>

@endsection