@extends('layouts.admin')
@section('contenido')

<div class="row">
   <div class="col-lg-12">
      <ol class="breadcrumb">
         <li> <i class="fa fa-home"></i> <a href="{{url('/admin/perfilpuesto')}}"> Administrar Perfiles </a></li>
         <li class="active"> <i class="fa fa-desktop"></i> Editar Perfil de Puesto</li>
      </ol>
   </div>
</div>

<div class="row">
   <div class="col-lg-12">
      <h3>Editar Perfil de Puesto</h3>
   </div>
</div>


<div class="row">
   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   @include('mensajes.messages')

{!!Form::model($perfil,['method'=>'PATCH','route'=>['admin.perfilpuesto.update',$perfil->IDPERFILPUESTO]])!!}
{{Form::token()}} 
         
         <div class="form-group">
   	     <label for="profesion">Profesion</label>
   	     <input type="text" name="profesion" required value="{{$perfil->PROFESION}}" class="form-control">
         </div>

   
         <div class="form-group">
   	     <label for="reporta">Reporta a</label>
   	     <input type="text" name="reporta" required value="{{$perfil->REPORTA}}" class="form-control">
         </div>

         <div class="form-group">
               <label for="sustituto">Sustituto</label>
               <input type="text" name="sustituto" required value="{{$perfil->SUSTITUTO}}" class="form-control">
         </div>

         <div class="form-group">
   	     <label for="relaciones">Relaciones Internas</label>
   	     <input type="text" name="relaciones" required value="{{$perfil->RELACIONES}}" class="form-control">
         </div>

      </div>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">  

         <div class="form-group">
               <label for="sustituye">Sustituye a</label>
               <input type="text" name="sustituye" required value="{{$perfil->SUSTITUYE}}" class="form-control">
         </div>
         <div class="form-group">
            <label for="responsabilidades">Responsabilidades Principales</label>
            <textarea  type="text" name="responsabilidades" required value="{{old('responsabilidades')}}" class="form-control"  rows=""  placeholder="Responsabilidades Principales...">{{$perfil->RESPONSABILIDADES}}</textarea>
         </div>
         <div class="form-group">
         <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-refresh"></i> Actualizar</button>
         <a href="{{url('/admin/perfilpuesto')}}" class="btn btn-danger" role="button"><i class="glyphicon glyphicon-remove-circle"></i> Cancelar</a>
   </div>
      </div>
    </div>     
{!!Form::close()!!}			
@endsection