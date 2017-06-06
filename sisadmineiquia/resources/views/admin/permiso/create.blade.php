@extends('layouts.admin')
@section('contenido')
 <div class="row">
    <div class="col-lg-12">
      <ol class="breadcrumb">
        <li><i class="fa fa-home"></i> <a href="{{url('/admin/permiso')}}"> Gestionar Permisos</a></li>
        <li class="active"><i class="fa fa-desktop"></i> Nuevo Permiso</li>
      </ol>
    </div>
 </div>
 
 <div class="row">
    <div class="col-lg-12">
       <h3> Solicitud de Permiso</h3><br>
   
 @include('mensajes.errores')
 @include('mensajes.messages')
  </div>
</div> 

 {!!Form::open(array('url'=>'admin/permiso','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}


<div class="row col-xs-10">
  <div class="panel panel-primary">
    <div class="panel-body">

      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <div class="form-group">
            <br><label for="cargoempleado">Cargo Empleado</label> 
            <input type="text" name="cargoempleado" id="cargoempleado" value="{{old('cargoempleado')}}" class="form-control" placeholder="Cargo del Empleado..." disabled>
          </div>
        </div>
    </div>

      <div class="row">
       <br><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="form-group">
            <label for="empleado"> Empleado </label>
            <select name="idexpediente" class="form-control selectpicker" id="idexpediente"  class="form-control" value="{{old('idexpediente')}}" data-live-search="true">
                  <option value="" selected>Seleccinar Empleado</option>
                @foreach ($empleados as $emp)
                  <option value="{{$emp->idexpediente}}_{{$emp->nombrepuesto}}">{{$emp->nombre}}</option>
                @endforeach
            </select>     
          </div>
        
          <div class="form-group">
            <br><label for="tiemposolicitado">Tiempo solicitado</label><br>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label>Horas</label>
                <input type="number" name="tiemposolicitadohora" required value="{{old('tiemposolicitadohora')}}" class="form-control" min="0"  placeholder="Horas...">
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label>Minutos</label>
                <input type="number" name="tiemposolicitadomin" required value="{{old('tiemposolicitadomin')}}" class="form-control" min="0" max="59" placeholder="Minutos...">
              </div> 
          </div>
        </div>
    
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="form-group">
            <label for="fechasolicitud">Fecha Solucitud</label>
            <input type="text" name="fechasolicitud" class="tcal form-control" required value="{{old('fechasolicitud')}}">
          </div>

        <div class="form-group">
            <label for="motivopermiso">Motivo</label>
            <textarea type="text" name="motivopermiso"  required value="{{old('motivopermiso')}}" class="form-control"  rows="3"  placeholder="Motivo del Permiso...">{{old('motivopermiso')}}</textarea> 
          </div>
          
        </div>
      </div>
      
    </div>
  </div>
</div>

<div class="row col-xs-10">
  <div class="panel panel-primary" id="panelpermiso">
    <div class="panel-body">

          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
              <label for="estadopermiso">Estado</label>
              <select name="estadopermiso" id="estadopermiso" class="form-control" value="{{old('motivopermiso')}}">
                <option value="">Seleccionar...</option>    
                <option value="1">Aprobado</option>
                <option value="2">Denegado</option>
              </select>     
            </div>
          </div>

          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
              <label for="gocesueldo">Goce de Sueldo </label>
              <select name="gocesueldo" id="gocesueldo" class="form-control">
                <option value="">Seleccionar...</option>    
                <option value="1">Si</option>
                <option value="2">No</option>
              </select>     
            </div>
          </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <div class="form-group">
            <label for="fechapermiso">Fecha de Registro</label>
            <input type="text" name="fechapermiso" class="tcal form-control" required value="{{old('fechasolicitud')}}">
          </div>
        </div>
    </div>
  </div>
</div>

  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
      <div class="form-group">
        <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button>
        <a href="{{url('admin/permiso')}}" class="btn btn-danger" role="button"><i class="glyphicon glyphicon-remove-circle"></i> Cancelar</a>
      </div>
    </div>
  </div>

{!!Form::close()!!} 

@push('scripts')
<script>

//$('#panelpermiso').hide();
$("#idexpediente").change(mostrarPuesto);
$("#estadopermiso").change(elegir);
$("#gocesueldo").change(elegir2);


function mostrarPuesto()
{
  dato=document.getElementById('idexpediente').value.split('_');
  $("#cargoempleado").val(dato[1]);
}

function elegir()
{
  dato=document.getElementById('estadopermiso').value.split(''); 
  if(dato==2)
    $("#gocesueldo").val(dato);

  //else
   //  $("#gocesueldo").val("");

}

function elegir2()
{
  p_estado=document.getElementById('estadopermiso').value.split('');
  //g_sueldo=document.getElementById('gocesueldo').value.split('');

  if(p_estado==2){
    $("#gocesueldo").val(p_estado);
  }
  
}

</script>
@endpush
@endsection