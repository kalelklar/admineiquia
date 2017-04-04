@extends('layouts.admin')
@section('contenido')
<div class="row">
      <div class="col-lg-12">
            <ol class="breadcrumb">
                  <li> <i class="fa fa-home"></i> <a href="{{url('/admin/acuerdos')}}"> Administrar Acuerdos Administrativos</a>
                  </li>
                  <li class="active">
                  <i class="fa fa-desktop"></i>Editar Acuerdo Administrativo</li>
            </ol>
      </div>
 </div>
 <div class="row">
      <div class="col-lg-12">
            <h3>Editar Acuerdo Administrativo</h3>
      </div>
 </div>
@include('mensajes.errores')
 <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      @include('mensajes.messages')
            {!!Form::model($acuerdos,['method'=>'PATCH','route'=>['admin.acuerdos.update',$acuerdos->IDACUERDO],'files'=>true])!!}

            {{Form::token()}}
            
            <div class="form-group">
                  <label for="idacuerdo">Código</label>
                  <input type="text" name="idacuerdo" class="form-control" placeholder="AC-000-0000" required value="{{$acuerdos->IDACUERDO}}" id="idacuerdo" readonly="readonly">
            </div> 
            <div class="form-group">
                  <label for="foto">Documento</label>
                  <input type="file"  class="form-control" name="archivoacuerdo">
                        @if(($acuerdos->archivoacuerdo)!="")
                              <a href="{{ URL::asset('acuerdos/'.$acuerdos->ARCHIVOACUERDO) }}" target="_blank">
                                    {{ $acuerdos->IDACUERDO }}
                              </a>
                        @endif
            </div>
            <div class="form-group">
                  <label for="idempleado">Empleado</label>
                  <select name="idempleado" class="form-control" id="idempleado">
                        @foreach ($empleados as $emp)
                              <option required value="{{$emp->idempleado}}">{{$emp->nombrecompleto}}</option>
                        @endforeach
                  </select>
            </div>
            <div class="form-group">
                  <label for="motivoacuerdo">Motivo</label>
                  <input type="text" name="motivoacuerdo" class="form-control" required value="{{$acuerdos->MOTIVOACUERDO}}" id="motivoAcuerdo" onkeyup="corregirMotivoAcuerdo();">
            </div>
             <div class="form-group">
                  <label for="descripcionacuerdo">Descripción</label>
                <textarea  name="descripcionacuerdo" id="descripcionAcuerdo" class="form-control"  rows="3" placeholder="Escribir descripción" onkeyup="corregirDescripcionAcuerdo();">{{$acuerdos->DESCRIPCIONACUERDO}}</textarea>
            </div>
            <div class="form-group">
                  <label for="fechaacuerdo">Fecha</label>
                  <input name="fechaacuerdo" class="tcal form-control" required value="{{$acuerdos->FECHAACUERDO}}" id="fechaAcuerdo" onkeyup="corregirFechaAcuerdo();">
            </div>
            <div class="form-group">
                  <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-refresh"></i> Actualizar</button>
                  <a href="{{url('/admin/acuerdos')}}" class="btn btn-danger" role="button"><i class="glyphicon glyphicon-remove-circle"></i> Cancelar</a>
            </div>
      </div>
                  {!!Form::close()!!}           

</div>



@endsection