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
  </div><br>

 <div class="row">
    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
      @include('mensajes.messages')
      @include('mensajes.errores')
    </div>
 </div>
 
 @foreach ($asistencia as $asis)         
 @endforeach
  @foreach ($detalles as $det)         
 @endforeach
 
 {!!Form::model($asistencia,['method'=>'PATCH','route'=>['admin.asistencia.update',$asis->idasistencia]])!!}
 {{Form::token()}} 


  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="form-group">
      <h4 for="fechaasistencia">Fecha : {{$asis->fechaasistencia}}</h4> 
      <input type="hidden" name="fechaasistencia" class="form-control" id="fechaasistencia" value="{{$asis->fechaasistencia}}">
    </div>
  </div>

  <div class="col-lg-1 col-md-1 col-sm-1 col-xs-4">
    <div class="form-group">
      <input type="hidden" name="idasistencia" id="idasistencia" value="{{$asis->idasistencia}}" class="form-control" >
    </div>
  </div>

  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="form-group">
      @if ($asis->turno=='0')
              <h4 for="turno" >Turno : {{"Mañana"}}</h4>
            @else
              <h4 for="turno" >Turno : {{"Tarde"}}</h4>
          @endif
     <input type="hidden" name="turno" class="form-control" id="turno" value="{{$asis->turno}}">
    </div>
  </div> 
  
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" class="form-check has-danger">
          <div class="table-responsive"><br>
            <table class="table table-striped table-bordered table-condensed table-hover" id="detalles" >
              
              <thead style="background-color: #A9D0F5">
                <th>Estado</th>
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
                <td>
                  <select name="asistio[]" id="asistio" class="btn btn-success">
                  @if ($det->asistio=='0')
                    <option value="0" selected>{{"Falta"}}</option>
                    <option value="1">{{"Asistio"}}</option>
                    <option value="2">{{"Permiso"}}</option>
                    @else
                      @if ($det->asistio=='1')
                        <option value="0">{{"Falta"}}</option>
                        <option value="1" selected>{{"Asistio"}}</option>
                        <option value="2">{{"Permiso"}}</option>
                        @else
                          <option value="0"> Falta</option>
                          <option value="1"> Asistio</option>
                          <option value="2" selected> Permiso</option>
                      @endif    
                  @endif
                  </select>

                  <input type="hidden" name="iddetalle[]" id="iddetalle" value="{{$det->iddetalle}}">
                </td>
                <td><input type="hidden" name="idexpediente[]" id="idexpediente" value="{{$det->idexpediente}}">{{$det->idexpediente}}</td>
                <td><input type="hidden" name="nombre[]" value="{{$det->nombre}}">
                <input type="hidden" name="idempleado[]" value="{{$det->idempleado}}">{{$det->nombre}}</td>
                <td><input type="time" class="form-control"  name="horaentrada[]"  value="{{$det->horaentrada}}" max="21:00" min="05:00"></td>
                <td><input type="time" class="form-control"  name="horasalida[]" value="{{$det->horasalida}}" max="21:00" min="05:00"></td>
                <td><input type="text" class="form-control"  name="observaciones[]" value="{{$det->observaciones}}"></td>
              </tr>
             @endforeach
            </tbody>
           </table>  
          </div>
         </div>
  
 
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="btn_guardar"> 
        <div class="form-group">
          <input type="hidden" name="_token" value="{{csrf_token()}}"></input>
          <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-floppy-disk"></i> Actualizar</button>
          <a href="{{url('admin/asistencia')}}" class="btn btn-danger" role="button">
          <i class="glyphicon glyphicon-remove-circle"></i> Cancelar</a>
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