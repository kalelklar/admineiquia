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
@include('mensajes.errores')
 <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      @include('mensajes.messages')
    </div>
  </div>

 {!!Form::open(array('url'=>'admin/asistencia','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

  <div class="row"> 
 
     <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
          <label for="fechaasistencia">Fecha</label>
          <input type="text" name="fechaasistencia" class="tcal form-control" id="fechaapertura" required value="{{old('fechaasistencia')}}" class="form-control" placeholder="00/00/0000" >
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
  </div>

	<div class="row col-xs-12">
    <div class="panel panel-primary">
      <div class="panel-body">
             
          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="form-group">
              <label for="empleado"> Empleado </label>
              <select name="idexpediente" class="form-control selectpicker" id="idexpediente" class="form-control" data-live-search="true">
                  @foreach ($empleados as $emp)
                    <option value="{{$emp->idexpediente}}">{{$emp->nombre}}</option>
                  @endforeach
              </select>     
            </div>
          </div>

          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <div class="form-group">
              <label for="horaentrada">Hora de Entrada</label>
              <input type="time" name="horaentrada"  id="horaentrada" value="06:00" max="22:30" min="05:00" value="{{old('horaentrada')}}" class="form-control" >
            </div>
          </div>

          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <div class="form-group">
              <label for="horasalida">Hora de Salida</label>
              <input type="time" name="horasalida"  id="horasalida" value="06:00" max="22:30" min="05:00" value="{{old('horasalida')}}" class="form-control" >
            </div>
          </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <div class="form-group">
                <label for="observaciones">Observaciones</label>
                <input type="text" name="observaciones"  id="observaciones" value="{{old('observaciones')}}" class="form-control" placeholder="Observaciones...">
              </div>
            </div>

            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
              <div class="form-group">
                 <br>
                 <button type="button" id="bt_add" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Agregar</button>
              </div>
            </div> 

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
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
                    </tbody>
              </table>  
            </div>
        </div>
      </div>


		  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="btn_guardar"> 
        <div class="form-group">
          <input type="hidden" name="_token" value="{{csrf_token()}}"></input>
          <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button>
          <button class="btn btn-danger" type="reset"><i class="glyphicon glyphicon-remove-circle"></i> Cancelar</button>
        </div>
      </div>
  </div>

{!!Form::close()!!}	

@push('scripts')
<script>

    $(document).ready(function(){
      $('#bt_add').click(function(){
        agregar();
      });
    });
    
    var cont=0;
    cant=0;
    $('#btn_guardar').hide();

    function agregar()
    { 
      
      idexpediente=$("#idexpediente").val();
      nombre=$("#idexpediente option:selected").text();
      horaentrada=$("#horaentrada").val();
      horasalida=$("#horasalida").val();
      observaciones=$("#observaciones").val();

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
          var fila='<tr class="selected" id="fila'+cont+'"> <td><button type="button" class="btn btn-danger" onclick="eliminar('+cont+');"><i class="glyphicon glyphicon-trash"></i></button></td> <td><input type="hidden" name="idexpediente[]" value="'+idexpediente+'">'+idexpediente+'</td> <td><input type="hidden" name="idempleado[]" value="'+idexpediente+'">'+nombre+' </td> <td><input type="time" name="horaentrada[]" class="form-control" value="'+horaentrada+'"></td> <td><input type="time" name="horasalida[]" class="form-control" value="'+horasalida+'"></td> <td><input type="text" name="observaciones[]" class="form-control" value="'+observaciones+'"></td> </tr>';
      
        cont++;
        cant++;
        limpiar();
        evaluar();
        $("#cantidad").html("Detalles"+": "+cant);
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

    function limpiar(){
      $("#horaentrada").val("");
      $("#horasalida").val("");
      $("#observaciones").val("");
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

    function eliminar(index){
      cant--;
      $("#cantidad").html("Detalles"+": "+cant);
      $('#fila'+index).remove();
      evaluar();    
    }

</script>
@endpush
@endsection