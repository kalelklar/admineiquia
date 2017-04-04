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
       <h3>Solicitud de Permiso</h3>
    </div>

    @include('mensajes.errores')
    @include('mensajes.messages')
</div>

  @foreach ($permiso as $per)         
  @endforeach
  {!!Form::model($permiso,['method'=>'PATCH','route'=>['admin.permiso.update',$per->idpermiso]])!!}
  {{Form::token()}}  

  <div class="row col-xs-10">
    <div class="panel panel-primary">
      <div class="panel-body">

        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
              <br><label for="cargoempleado">Cargo Empleado</label>
              <input type="text" id="cargoempleado" value="{{$per->nombrepuesto}}" class="form-control" placeholder="Cargo del Empleado..." disabled>
            </div>
          </div>
      </div>


      <div class="row">
        <br><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="form-group">
            <label for="empleado"> Empleado </label>
            <input type="text" name="idexpediente" id="idexpediente" value="{{$per->nombre}}" class="form-control" placeholder="Cargo del Empleado..." disabled>     
          </div>
          
          <div class="form-group">
            <br><label for="tiemposolicitado">Tiempo solicitado</label><br>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <input type="number" name="tiemposolicitadohora" required value="{{$per->tiemposolicitadohora}}" class="form-control" min="0"  placeholder="Horas...">
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <input type="number" name="tiemposolicitadomin" required value="{{$per->tiemposolicitadomin}}" class="form-control" min="0" max="59" placeholder="Minutos...">
              </div> 
          </div>
         </div>
      
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
              <label for="fechasolicitud">Fecha Solicitud</label>
              <input type="text" name="fechasolicitud" class="tcal form-control" required value="{{$per->fechasolicitud}}" value="{{old('fechasolicitud')}}" class="form-control" >
            </div>

            <div class="form-group">
              <label for="motivopermiso">Motivo</label>
              <textarea type="text" name="motivopermiso" required value="{{$per->motivopermiso}}" value="{{old('motivopermiso')}}" class="form-control"  rows="3">{{$per->motivopermiso}}</textarea>
            </div>

            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
              <div class="form-group">
                <input type="hidden" name="idexpediente" value="{{$per->idexpediente}}" class="form-control">
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>

  <div class="row col-xs-10">
    <div class="panel panel-primary">
      <div class="panel-body">

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <div class="form-group">
                <label for="estadopermiso">Estado</label>
                <select name="estadopermiso" class="form-control">
                  @if($per->gocesueldo==0)
                    <option value="" selected>En espera</option>
                    <option value="1" >Aprobado</option>
                    <option value="2" >Denegado</option>
                  @else @if($per->gocesueldo==1)
                     <option value="0" >En espera</option>
                     <option value="1" selected>Aprobado</option>
                     <option value="2" >Denegado</option>
                        @else
                        <option value="0" >En espera</option>
                        <option value="1" >Aprobado</option>
                        <option value="2" selected>Denegado</option>
                        @endif
                  @endif     
                </select>     
              </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <div class="form-group">
                <label for="gocesueldo">Goce de Sueldo </label>
                <select name="gocesueldo" id="gocesueldo" class="form-control">
                  @if($per->gocesueldo==0)
                    <option value="" selected>Sin contestar</option>
                    <option value="1">Si</option>
                    <option value="2">No</option>
                  @else @if($per->gocesueldo==1)
                    <option value="0">Sin contestar</option>
                    <option value="1" selected>Si</option>
                    <option value="2">No</option>
                        @else
                        <option value="0">Sin contestar</option>
                        <option value="1">Si</option>
                        <option value="2" selected>No</option>
                        @endif
                  @endif
                </select>     
              </div>
            </div>

          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
              <label for="fechapermiso">Fecha Ingreso</label>
              <input type="text" name="fechapermiso" class="tcal form-control" value="{{$per->fechapermiso}}" required value="{{old('fechapermiso')}}" class="form-control" >
            </div>
          </div>
      </div>
    </div>
  </div>
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
        <div class="form-group">
          <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-refresh"></i> Guardar</button>
          <button class="btn btn-danger" type="reset"><i class="glyphicon glyphicon-remove-circle"></i> Cancelar</button>
        </div>
      </div>
    </div>    

{!!Form::close()!!}		
@push('scripts')

<script>

$("#idexpediente").change(mostrarPuesto);

function mostrarPuesto()
{
  dato=document.getElementById('idexpediente').value.split('_');
  $("#cargoempleado").val(dato[1]);
}

</script>

@endpush         
@endsection