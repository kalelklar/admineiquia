@extends('layouts.admin')
@section('contenido')
<div class="row">
   <div class="col-lg-12">
   <ol class="breadcrumb">
      <li> <i class="fa fa-home"></i> <a href="{{url('/admin/perfilpuesto')}}">Administrar Perfiles</a>
      </li>
      <li class="active">
      <i class="fa fa-desktop"></i> Nuevo Perfil de Puesto</li>
    </ol>
   </div>
</div>
<div class="row">
   <div class="col-lg-12">
         <h3>Nuevo Perfil de Puesto</h3>

   </div>
</div>
@include('mensajes.errores')
<div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
         @include('mensajes.messages')
			{!!Form::open(array('url'=>'admin/perfilpuesto','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}

                  <div class="form-group">
                        <label for="profesion">Profesion</label>
                        <input type="text" name="profesion" required value="{{old('profesion')}}" class="form-control" placeholder="Profesion...">
                  </div>

                  <div class="form-group">
                        <label for="reporta">Reporta a</label>
                        <input type="text" name="reporta" required value="{{old('reporta')}}" class="form-control" placeholder="Reporta a...">
                  </div>
            
                  <div class="form-group">
                        <label for="sustituto">Sustituto</label>
                        <input type="text" name="sustituto" required value="{{old('sustituto')}}" class="form-control" placeholder="Sustituto...">
                  </div>

                  <div class="form-group">
                        <label for="relaciones">Relaciones Internas</label>
                        <input type="text" name="relaciones" required value="{{old('relaciones')}}" class="form-control" placeholder="Relaciones Internas...">
                  </div>
              </div>

               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                  <div class="form-group">
                        <label for="sustituye">Sustituye a</label>
                        <input type="text" name="sustituye" required value="{{old('sustituye')}}" class="form-control" placeholder="Sustituye a...">
                  </div>
                  <div class="form-group">
                     <label for="responsabilidades">Responsabilidades Principales</label>
                     <textarea  type="text" name="responsabilidades" required value="{{old('responsabilidades')}}" class="form-control"  rows=""  placeholder="Responsabilidades Principales..."></textarea>
                  </div>

                  <div class="form-group">
                        <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button>
                        <button class="btn btn-danger" type="reset"><i class="glyphicon glyphicon-remove-circle"></i> Cancelar</button>
                  </div>

                </div>

            </div> 

      {!!Form::close()!!}           
               
@endsection