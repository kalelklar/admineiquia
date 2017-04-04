<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SEIQUIA - FIAUES</title>

    <link href="{{ public_path()}}/css/asignacionacademica.css" rel="stylesheet">
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 15px;
}
</style>
</head>
<body>
<div id="contenedor">
<header>
<div id="logo">
        @if(is_file(public_path().'/fotos/logo/logoUES.png'))
        <div class="foto">
            <img src="{{ public_path()}}/fotos/logo/logoUES.png" height="110px" width="110px" class="img-thumbnail">
        </div>
        @else
        <div class="foto">
            <img src=""  class="img-thumbnail">
        </div>
        @endif
    </div>
    <div>
        <h3>UNIVERSIDAD DE EL SALVADOR</h3>
        <h3>FACULTAD DE INGENIERIA Y ARQUITECTURA</h3>
        <h3>ESCUELA DE INGENIERIA QUIMICA E INGENIERIA DE ALIMENTOS</h3>
    </div>
</header>

@foreach ($empleado as $emp)
<section> 
<h3><b><i>Docente:</i></b><i>{{$emp->nombrecompleto}}</i></h3>
</section>
@endforeach
@foreach ($cargaacademica as $asigacad)
<section>
<div id="reporteacademico">
    <table style="width:100%">
<tr>
<td>Ciclo</td>
<td>Año</td>
</tr>

<tr>
@if($asigacad->idciclo=='1')
        <td>Ciclo I</td>
        @else
        <td>Ciclo II</td>
        @endif
<td>{{$asigacad->ano}}</td>
</tr>
    </table>
   
<br></br>
    <table style="width:100%">
<tr>
    <td colspan="5" align="center"><h2>Asignacion Academica</h2></td>
  </tr>
  <tr>
    <th>Cod Asignatura</th>
    <th>Asignatura</th>
    <th>GT</th> 
    <th>GD</th>
    <th>GL</th>
  </tr>
  <tr>
   <td>{{$asigacad->codasignatura}}</td>
    <td>{{$asigacad->nombreasignatura}}</td>
    <td>{{$asigacad->gteorico}}</td>
    <td>{{$asigacad->gdiscusion}}</td>
    <td>{{$asigacad->glaboratorio}}</td>
  </tr>
<tr>
    <td colspan="4">Tiempo Total</td>
    <td>{{$asigacad->tiempototal}}</td>
  </tr>
</table>
<br></br>
   <table style="width:100%">
  <tr>
  <th><center><h2>Responsabilidad Administrativa</h2></center></th>
  </tr>
  <tr>
   <th>{{$asigacad->responsabilidadadmin}}</th>
  </tr>
</table>

</div>
</section>
  <div style="clear:both"></div>
 @endforeach

<!-- Fin Contenido-->
</div>
</body>
</html>