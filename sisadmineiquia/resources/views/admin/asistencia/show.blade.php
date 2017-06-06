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
 </div><br>


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
      </div><br><br>

  <br><div class="row col-lg-12">
  
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <table class="table table-striped table-bordered table-condensed table-hover" id="tabladetalles" >
            <thead style="background-color: #A9D0F5">
                <th>Asistencia</th>
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
                  @if($det->asistio=='0')
                    <td><p style="color:red;">Falta</p></td>
                      @else
                        @if($det->asistio=='1') 
                          <td><p style="color:#239B56";>Asistio</p></td>   
                          @else
                            <td><p style="color:#2471A3";>Permiso</p></td> 
                        @endif
                  @endif 
      
                  <td>{{$det->idexpediente}}</td>
                  <td>{{$det->nombre}}</td>
                  <td><input type="time" class="form-control"  name="horaentrada[]" value="{{$det->horaentrada}}" disabled></td>
                  <td><input type="time" class="form-control"  name="horasalida[]" value="{{$det->horasalida}}" disabled></td>
                  <td>{{$det->observaciones}}</td>
              </tr>
              @endforeach
            </tbody>
        </table>  
    </div>
  </div>

  <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="btn_guardar"> 
        <div class="form-group">
          <a href="{{url('admin/asistencia')}}" class="btn btn-danger" role="button">
          <i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
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
