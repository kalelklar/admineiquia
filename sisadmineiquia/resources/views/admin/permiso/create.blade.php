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
              <select name="idexpediente" class="form-control selectpicker" id="idexpediente" class="form-control" value="{{old('idexpediente')}}" data-live-search="true">
                    <option value="0" selected>Seleccionar Empleado</option>
                  @foreach ($empleados as $emp)
                    <option value="{{$emp->idexpediente}}_{{$emp->nombrepuesto}}">{{$emp->nombre}}</option>
                  @endforeach
              </select>     
            </div>
          
            <div class="form-group">
              <br><label for="tiemposolicitado">Tiempo Solicitado</label><br>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <input type="number" name="tiemposolicitadohora" required value="{{old('tiemposolicitadohora')}}" class="form-control" min="0" max="72" placeholder="Horas...">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <input type="number" name="tiemposolicitadomin" required value="{{old('tiemposolicitadomin')}}" class="form-control" min="0" max="59" placeholder="Minutos...">
                </div> 
            </div>
          </div>
      
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
              <label for="fechasolicitud">Fecha Solicitud</label>
              <input type="text" name="fechasolicitud" class="tcal form-control" required value="{{old('fechasolicitud')}}" class="form-control" >
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
                <select name="estadopermiso" class="form-control">    
                  <option value="0">En espera</option>
                  <option value="1">Aprobado</option>
                  <option value="2">Denegado</option>
                </select>     
              </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <div class="form-group">
                <label for="gocesueldo">Goce de Sueldo </label>
                <select name="gocesueldo" id="gocesueldo" class="form-control">    
                  <option value="">Sin contestar</option>
                  <option value="1">Si</option>
                  <option value="2">No</option>
                </select>     
              </div>
            </div>

          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
              <label for="fechapermiso">Fecha de Ingreso</label>
              <input type="text" name="fechapermiso" class="tcal form-control" value="{{old('fechapermiso')}}" placeholder="00-00-0000" class="form-control" >
            </div>
          </div>
      </div>
    </div>
  </div>
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
        <div class="form-group">
          <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button>
          <button class="btn btn-danger" type="reset"><i class="glyphicon glyphicon-remove-circle"></i> Cancelar</button>
        </div>
      </div>
    </div>

{!!Form::close()!!} 

@push('scripts')
<script>

//$('#panelpermiso').hide();
$("#idexpediente").change(mostrarPuesto);

function mostrarPuesto()
{
  dato=document.getElementById('idexpediente').value.split('_');
  $("#cargoempleado").val(dato[1]);
}

</script>
@endpush
@endsection