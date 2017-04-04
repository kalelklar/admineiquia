@extends('layouts.admin')
@section('contenido')
 <div class="row">
    <div class="col-lg-12">
      <ol class="breadcrumb">
        <li><i class="fa fa-home"></i> <a href="{{url('/admin/asistencia')}}"> Gestionar Asistencia</a></li>
        <li class="active"><i class="fa fa-desktop"></i> Editar Asistencia</li>
      </ol>
    </div>
 </div>
 
 <div class="row">
    <div class="col-lg-12">
       <h3>Editar Asistencia</h3>
    </div>
  </div>
@include('mensajes.errores')
 <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      @include('mensajes.messages')
    </div>
 </div>
 
 @foreach ($asistencia as $asis)         
 @endforeach
  @foreach ($detalles as $det)         
 @endforeach
 
 {!!Form::model($asistencia,['method'=>'PATCH','route'=>['admin.asistencia.update',$asis->idasistencia]])!!}
 {{Form::token()}} 

 <div class="row">
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="form-group">
      <label for="fechaasistencia">Fecha</label>
      <input type="text" name="fechaasistencia" class="tcal form-control" id="fechaapertura" required value="{{$asis->fechaasistencia}}" class="form-control" >
    </div>
  </div>

  <div class="col-lg-1 col-md-1 col-sm-1 col-xs-4">
    <div class="form-group">
      <input type="hidden" name="idasistencia" id="idasistencia" required value="{{$asis->idasistencia}}" class="form-control" >
    </div>
  </div>

  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="form-group">
      <label for="turno"> Turno </label>
      <select name="turno" id="turno" class="form-control">
        @foreach ($asistencia as $asis)
          @if ($asis->turno=='0')
            <option value="0" selected>{{"Mañana"}}</option>
            <option value="1">{{"Tarde"}}</option>
          @else
            <option value="0">{{"Mañana"}}</option>
            <option value="1" selected>{{"Tarde"}}</option>
          @endif
        @endforeach       
      </select>     
    </div>
  </div>
 </div>


	<div class="row col-lg-12">
    <div class="panel panel-primary">
      <div class="panel-body">

          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="form-group">
              <label for="empleado"> Empleado </label>
              <select name="id_expediente" class="form-control selectpicker" id="id_expediente" class="form-control" data-live-search="true">
                  @foreach ($empleados as $emp)
                    <option value="{{$emp->idexpediente}}">{{$emp->nombre}}</option>
                  @endforeach
              </select>     
            </div>
          </div>

          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <div class="form-group">
              <label for="horaentrada">Hora de Entrada</label>
              <input type="time" name="hora_entrada"  id="hora_entrada" value="06:00" max="22:30" min="05:00" value="{{old('hora_entrada')}}" class="form-control" >
            </div>
          </div>

          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <div class="form-group">
              <label for="horasalida">Hora de Salida</label>
              <input type="time" name="hora_salida"  id="hora_salida" value="06:00" max="22:30" min="05:00" value="{{old('hora_salida')}}" class="form-control" >
            </div>
          </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <div class="form-group">
                <label for="observaciones">Observaciones</label>
                <input type="text" name="observacion"  id="observacion" value="{{old('observacion')}}" class="form-control" placeholder="Observaciones...">
              </div>
            </div>

            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
              <div class="form-group">
                 <label></label>
                 <button type="button" id="bt_add" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Agregar</button>
              </div>
            </div>


        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" class="form-check has-danger">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover" id="detalles" >
              
              <thead style="background-color: #A9D0F5">
                <th>Eliminar</th>
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
             @foreach($detalles as $det)
              <tr>
                <td>
                    <select name="eliminardetalle[]" id="eliminardetaller" class="btn btn-danger">
                    <option value="0" selected><i class="glyphicon glyphicon-trash"></i> Borrar</option>
                    <option value="1">SI</option></select>
                <input type="hidden" name="iddetalle[]" id="iddetalle" value="{{$det->iddetalle}}">
                </td>
                <td><input type="hidden" name="idexpediente[]" id="idexpediente" value="{{$det->idexpediente}}">{{$det->idexpediente}}</td>
                <td><input type="hidden" name="idempleado[]" value="{{$det->idempleado}}">{{$det->nombre}}</td>
                <td><input type="time" class="form-control"  name="horaentrada[]" value="{{$det->horaentrada}}"></td>
                <td><input type="time" class="form-control"  name="horasalida[]" value="{{$det->horasalida}}"></td>
                <td><input type="text" class="form-control"  name="observaciones[]" value="{{$det->observaciones}}"></td>
              </tr>
             @endforeach
            </tbody>
              </table>  
            </div>
        </div>
      </div>
     </div>
      </div>

     <div class="row">
		  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="btn_guardar"> 
        <div class="form-group">
          <input type="hidden" name="_token" value="{{csrf_token()}}"></input>
          <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-refresh"></i></i> Guardar</button>
          <button class="btn btn-danger" type="reset"><i class="glyphicon glyphicon-remove-circle"></i> Cancelar</button>
        </div>
      </div>
     </div>
    </div>

{!!Form::close()!!}	

@push('scripts')
<script>

$(document).ready(function(){
  $('#bt_deta').click(function(){
    mostrar();
  });
});
 
$(document).ready(function(){
  $('#bt_add').click(function(){ 
      agregar();
  });
});

  var cont=0;
  cant=0;
    

  function agregar()
  { 
      iddetalle="";
      idexpediente=$("#id_expediente").val();
      nombre=$("#id_expediente option:selected").text();
      horaentrada=$("#hora_entrada").val();
      horasalida=$("#hora_salida").val();
      observaciones=$("#observacion").val();

      if(idexpediente!="" && nombre!="" &&  horaentrada!="" && horasalida!="")
      {
        var Hora1 = horaentrada; 
        var Hora2 = horasalida;

        var h="";
        var m="";
      

        h = Hora1.substr(0,2); 
        m = Hora1.substr(3,4);

        var hh1 = parseInt(h); 
        var mm1 = parseInt(m); 

        h = Hora2.substr(0,2); 
        m = Hora2.substr(3,4);

        var hh2 = parseInt(h); 
        var mm2 = parseInt(m);  
     
        // Comparar 
        if (hh1<hh2 || (hh1==hh2 && mm1<mm2))
        {
          var fila='<tr class="selected" id="fila'+cont+'"> <td> <input type="hidden" name="iddetalle[]" value="'+iddetalle+'"> <button type="button" class="btn btn-danger" onclick="eliminar('+cont+');"><i class="glyphicon glyphicon-trash"></i> Borrar</button></td> <td><input type="hidden" name="idexpediente[]" value="'+idexpediente+'">'+idexpediente+'</td> <td><input type="hidden" name="idempleado[]" value="'+idexpediente+'">'+nombre+' </td> <td><input type="time" class="form-control" name="horaentrada[]" value="'+horaentrada+'"></td> <td><input type="time" class="form-control" name="horasalida[]" value="'+horasalida+'"></td> <td><input type="text" class="form-control" name="observaciones[]" value="'+observaciones+'"></td></tr>';
      
        cont++;
        cant++;
        limpiar();
        evaluar();
        $("#cantidad").html("Nuevos Detalles"+": "+cant);
        $('#detalles').append(fila);

        } 
        else{
            if(hh1>hh2 || (hh1==hh2 && mm1>mm2))  
              alert("¡Error, Hora Entrada es mayor que Hora Salida!"); 
            else   
              alert("¡Error, Hora Entrada es igual que Hora Salida!"); 
        }    

      }    
      else{
          alert("¡Error al ingresar el detalle, revise los datos!");
      }

  }

  function limpiar()
  {
      $("#hora_entrada").val("");
      $("#hora_salida").val("");
      $("#observacion").val("");
  }

  function evaluar()
  {
      if(cant>0){
        $('#btn_guardar').show();
      }
      else{
        $('#btn_guardar').hide();
      }
  }

  function eliminar(index)
  {
      cant--;
      $("#cantidad").html("Nuevos Detalles"+": "+cant);
      $('#fila'+index).remove();
      evaluar();    
  }

</script>
@endpush
@endsection