@extends ('layouts.admin')
@section ('contenido')
<div class="row">
   <div class="col-lg-12">
     <ol class="breadcrumb">
        <li><i class="fa fa-home"></i> 
        <a href="{{url('/admin/permiso')}}"> Gestionar Permisos</a></li>
        <li class="active">
        <i class="fa fa-desktop"></i> Listado de Permisos</li>
        </ol>
    </div>
</div>
          
<div class="row">
    <div class="col-lg-12">
        <label><a href="{{url('/admin/permiso/create')}}" class="btn btn-success btn-lg" role="button"> <i class="glyphicon glyphicon-plus"></i>  Nueva Permiso</a></label>
        @include('mensajes.messages')
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h2>Listado de Permisos</h2>
	</div>
</div>
 
<div class="row">
	<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12"><br>
		<div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover" id="tablapermiso" >
                <thead style="background-color: #A9D0F5"> 
                    <th>Id</th>
					<th>Expediente</th>
					<th>Empleado</th>
                    <th>Fecha Solicitud</th>
                    <th>Motivo</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>
               @foreach ($permisos as $per)
				<tr>
					<td>{{$per->idpermiso}}</td>
                    <td>{{$per->idexpediente}}</td>
                    <td>{{$per->nombre}}</td>
                    <td>{{$per->fechasolicitud}}</td>
                    <td>{{$per->motivopermiso}}</td>
                    @if($per->estadopermiso=='0')
                       <td>En espera</td>
                      @else
                         @if($per->estadopermiso=='1')
                           <td>Aprobado</td>
                         @else 
                           <td>Denegado</td>
                         @endif   
                    @endif
					<td>
						
                        <a href="{{URL::action('PermisoController@edit',$per->idpermiso)}}"><button class="btn btn-xs btn-primary"><i class="glyphicon  glyphicon-edit"></i> Editar</button></a>
                        <a href="" data-target="#modal-delete-{{$per->idpermiso}}" data-toggle="modal"><button class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove-circle"></i> Eliminar</button></a>
					</td>
				</tr>
				@include('admin.permiso.modal')
				@endforeach
			</table>
		</div>
	</div>
</div>

@push('scripts')
<script>

$(document).ready(function(){
    $('#tablapermiso').DataTable();
    });
</script>
@endpush
@endsection