@extends('layouts.admin')
@section('contenido')
<div class="row">
  <div class="col-lg-12">
    <ol class="breadcrumb">
      <li> <i class="fa fa-home"></i> <a href="{{url('/admin/tiempo')}}"> Administrar Tiempo Adicional</a>
      </li>
      <li class="active">
        <i class="fa fa-desktop"></i> Editar Tiempo Adicional</li>
      </ol>
    </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <h3>Editar Tiempo Adicional</h3>
  </div>
</div>
@include('mensajes.errores')
 <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			 @include('mensajes.messages')
      {!!Form::model($tiempo,['method'=>'PATCH','route'=>['admin.tiempo.update',$tiempo->IDTIEMPO],'files'=>'true'])!!}
        	<div class="form-group">
                  <label>Empleado</label>
                  <select name="idempleado" class="form-control" id="idempleado">
                   @foreach ($empleados as $emp)
                         <option value="{{$emp->idexpediente}}">{{$emp->nombrecompleto}}</option>
                   @endforeach
                  </select>       
            </div>
            <div class="form-group">
              <label for="ano">Año</label>
              <select name="ano" class="form-control" required id="ano">
                @foreach ($empleados as $emp)
                @for($i=date('o'); $i>=1910; $i--)
                <option value="{{$i}}" @if ($i == $emp->ano) selected @endif>{{$i}}</option>
                @endfor
                @endforeach
                </select>
            </div>
            <div class="form-group">
                  <label>Codigo Ciclo</label>
                  <select name="idciclo" class="form-control" required id="idciclo">
                  @foreach ($empleados as $emp)
                   @foreach ($ciclos as $c)
                         <option value="{{$c->idciclo}}" @if ($c->idciclo == $emp->idciclo) selected @endif>{{$c->nombreciclo}}</option>
                   @endforeach
                   @endforeach
                  </select>  
            </div>
            <div class="form-group">
                <label>Tiempo Adicional Inicio:</label>
                <input  type="text" name="tiempoadicionalinicio" id="tiempoadicionalinicio" class="tcal form-control" required  value="{{$tiempo->FECHAINICIO}}" placeholder="00-00-0000" id="tiempoadicionalinicio">
            </div>
            <div class="form-group">
                <label>Tiempo Adicional Fin:</label>
                <input type='text' name="tiempoadicionalfin" id="tiempoadicionalfin" class="tcal form-control" required value="{{$tiempo->FECHAFIN}}" placeholder="00-00-0000" id="tiempoadicionalfin" onkeyup="corregirFechaFinTiempoAdicional();"/>
            </div>
                    
            <div class="form-group">
                <label>Descripcion</label>
                <textarea  name="descripcion" id="descripcion" class="form-control"  rows="3" placeholder="Descripcion de el Tiempo Adicional">{{$tiempo->DESCRIPCION}}</textarea>
            </div>
            <div class="form-group">
                  <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-refresh"></i> Actualizar</button>
                  <a href="{{url('/admin/tiempo')}}" class="btn btn-danger" role="button"><i class="glyphicon glyphicon-remove-circle"></i> Cancelar</a>
            </div>
		</div>            
 </div>
                    {!!Form::close()!!}		

@endsection
