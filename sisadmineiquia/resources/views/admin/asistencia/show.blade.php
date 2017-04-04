@extends('layouts.admin')
@section('contenido')
 <div class="row">
  <div class="col-lg-12">
  <ol class="breadcrumb">
    <li> <i class="fa fa-home"></i> <a href="{{url('admin/asistencia')}}"> Gestionar Asistencia</a>
    </li>
    <li class="active">
    <i class="fa fa-desktop"></i>Registro de Aistencia</li>
    </ol>
  </div>
 </div>

 <div class="row">
    <div class="col-lg-12">
       <h3>Listado de Asistencia</h3>
    </div>
     @foreach($asistencia as $asis)
     @endforeach 
 </div>

	<div class="row">
     <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
      <div class="form-group">
          <h4 for="fechaasistencia">Fecha : {{$asis->fechaasistencia}}</h4> 
      </div>
      </div>

       <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
       <div class="form-group">
          @if ($asis->turno=='0')
              <h4 for="turno" >Turno : {{"Mañana"}}</h4>
            @else
              <h4 for="turno" >Turno : {{"Tarde"}}</h4>
          @endif
        </div>
      </div>
  </div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">                
        </div>
     </div>


  <div class="row col-lg-11">
      <div class="panel panel-primary">
          <div class="panel-body">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <table class="table table-striped table-bordered table-condensed table-hover" id="detalles" >
            <thead style="background-color: #A9D0F5">
                <th>Expediente</th>
                <th>Empleado</th>
                <th>Hora Entrada</th>
                <th>Hora Salida</th>
                <th>Observaciones</th>
            </thead>
            <tfoot>
            </tfoot>
            <tbody>
             
              @foreach($detalles as $det)
              <tr>
                  <td>{{$det->idexpediente}}</td>
                  <td>{{$det->nombre}}</td>
                  <td>{{$det->horaentrada}}</td>
                  <td>{{$det->horasalida}}</td>
                  <td>{{$det->observaciones}}</td>
              </tr>
              @endforeach
            </tbody>
        </table>  
    </div>

  </div>
  </div>
  </div> 
 
@push('scripts')
<script>

$(document).ready(function(){
    $('#tabladetalles').DataTable();
    });

</script>
@endpush
@endsection
