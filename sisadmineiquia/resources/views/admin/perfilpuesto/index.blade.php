@extends ('layouts.admin')
@section ('contenido')
<div class="row">
                <div class="col-lg-12">
                     <ol class="breadcrumb">
                          <li>
                              <i class="fa fa-home"></i> <a href="{{url('/admin/perfilpuesto')}}">Administrar Perfiles</a>
                          </li>
                          <li class="active">
                              <i class="fa fa-desktop"></i>
                               Administrar Perfiles de Puesto
                            </li>
                        </ol>
                    </div>
               
                <!-- /.row -->
         <div class="col-lg-12">
               <label><a href="{{url('/admin/perfilpuesto/create')}}" class="btn btn-success btn-lg" role="button"> <i class="fa fa-plus"></i> Nuevo Perfil</a></label>
        </div>
        <div class="col-lg-12">
        @include('mensajes.messages')
        </div>
</div>
                 
            <!-- /.row -->

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h2>Perfiles de Puestos</h2>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover" id="tablaperfilpuesto">
				<thead>
					<th>Id</th>
					<th>Profesion</th>
					<th>Reporta a:</th>
					<th>Sustituto</th>
					<th>Relaciones Internas</th>
					<th>Responsabilidades</th>
					<th>Sustituye a:</th>
					<th>Opciones</th>
				</thead>
               @foreach ($perfil as $per)
				<tr>
					<td>{{ $per->idperfilpuesto}}</td>
					<td>{{ $per->profesion}}</td>
					<td>{{ $per->reporta}}</td>
					<td>{{ $per->sustituto}}</td>
				    <td>{{ $per->relaciones}}</td>
				    <td>{{ $per->responsabilidades}}</td>
				    <td>{{ $per->sustituye}}</td>
					<td>
						<a href="{{URL::action('PerfilPuestoController@edit',$per->idperfilpuesto)}}"><button class="btn btn-xs btn-primary"><i class="glyphicon  glyphicon-edit"></i> Editar</button></a>
                        <a href="" data-target="#modal-delete-{{$per->idperfilpuesto}}" data-toggle="modal"><button class="btn btn-xs btn-danger">
                        <i class="glyphicon glyphicon-remove"></i> Eliminar</button></a>
					</td>
				</tr>
				@include('admin.perfilpuesto.modal')
				@endforeach
			</table>
		</div>
	</div>
</div>

@endsection