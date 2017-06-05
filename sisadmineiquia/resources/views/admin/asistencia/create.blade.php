@extends('layouts.admin')
@section('contenido')
 <div class="row">
    <div class="col-lg-12">
      <ol class="breadcrumb">
        <li><i class="fa fa-home"></i> <a href="{{url('/admin/asistencia')}}"> Gestionar Asistencia</a></li>
        <li class="active"><i class="fa fa-desktop"></i> Ingresar Asistencia</li>
      </ol>
    </div>
 </div>
  
 <div class="row">
    <div class="col-lg-12">
       <h3>Nueva Asistencia</h3>
    </div>
 </div>

 <div class="row">
    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
      @include('mensajes.messages')
      @include('mensajes.errores')
    </div>
  </div><br>

 {!!Form::open(array('url'=>'admin/asistencia','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

<div class="panel panel-primary">
  <div class="panel-body">
    <div class="row col-xs-12">

    <div class="row"> 
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
          <label for="fechaasistencia">Fecha</label>
          <input type="text" name="fechaasistencia" class="tcal form-control" id="fechaasistencia" required value="{{old('fechaasistencia')}}" class="form-control" placeholder="00/00/0000" >
        </div>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
          <label for="turno"> Turno </label>
          <select name="turno" id="turno" class="form-control">    
              <option value="0">Mañana</option>
              <option value="1">Tarde</option>
          </select>     
        </div>
      </div>
    </div><br>
       
		<table class="table table-striped table-bordered table-condensed table-hover" id="detalles" >
              
      <thead style="background-color: #A9D0F5">
            <th>Asistencia</th>
            <th>Expediente</th> 
            <th>Empleado</th>
            <th>Hora Entrada</th>
            <th>Hora Salida</th>
            <th>Observaciones</th>
      </thead>
      <tfoot>
            <th><h5 id="cantidad"></h5></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
      </tfoot>
      <tbody>
        @foreach($empleados as $emp)
          <tr>
            <td>             
              <select name="asistio[]" id="asistio" class="btn btn-success">
                <option value="0" selected><i class="glyphicon glyphicon-trash"></i> Falta</option>
                <option value="1" class=".azul"> Asistio</option>
                <option value="2"> Permiso</option>
              </select>
            </td>
            <td><input type="hidden" id="idexpediente" name="idexpediente[]" value="{{$emp->idexpediente}}">{{$emp->idexpediente}}
            </td>
            <td><input type="hidden" id="idempleado" name="idempleado[]" value="{{$emp->idempleado}}">{{$emp->nombre}}
            </td>
            <td><input type="time" class="form-control" max="21:00" min="05:00" id="horaentrada" name="horaentrada[]" value="{{old('horaentrada')}}"></td>

            <td><input type="time" class="form-control" max="21:00" min="05:00" id="horasalida" name="horasalida[]" value="{{old('horasalida')}}"></td>

           <td><input type="text" class="form-control" id="observaciones" name="observaciones[]" value="{{old('observaciones')}}" ></td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="btn_guardar"> 
        <div class="form-group">
          <input type="hidden" name="_token" value="{{csrf_token()}}"></input>
          <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button>
          <a href="{{url('admin/asistencia')}}" class="btn btn-danger" role="button">
          <i class="glyphicon glyphicon-remove-circle"></i> Cancelar</a>
        </div>
      </div>
    </div>

    </div>
  </div>
</div>


{!!Form::close()!!}	

@push('scripts')
<script>

 $("#asistio").change(asiste);

  /*  $(document).ready(function(){
      $('#asistio').click(function(){
        asiste();

      });
    });  */

    function asiste()
  {
   $("#horaentrada").hidden();
    horasalida=$("#horasalida")
    horaentrada.style.visibility='hidden';

    //bt=document.getElementsByTagName(idexpediente)
    //$('#bt').hide();
    
    bt1=document.getElementById(horaentrada)
    bt1.style.visibility='hidden';
    bt2=document.getElementById(horasalida)
    bt2.style.visibility='hidden';
  }

</script>
@endpush
@endsection