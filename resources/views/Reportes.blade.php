@extends('layouts.master')

@section('content')
<div class="row">

  <div class="col-md-4 col-md-offset-4">
    <div class="thumbnail">
      <center><h1 style="font-family: monospace">Generar reporte</h1></center>
      <form class="" action="{{ route('productos.generarExcel') }}" method="post">
        {{ csrf_field() }}
        <label for="email" style="font-family: monospace; font-weight: 900">Fecha inicio:</label>
        <input type="date" name="Inicio" style=" font-family: monospace; font-weight: 900;">
        <br>
        <label for="email" style="font-family: monospace; font-weight: 900">Fecha Fin: </label>
        <input type="date" name="Fin" style=" font-family: monospace; font-weight: 900;">
        <br><br>
        <center><button type="submit" name="button" class="btn" style="background-color: #5D2D00; font-family: monospace; font-weight: 900; color:white;">Generar Reporte</button></center>
      </form>
    </div>
  </div>

</div>
@endsection
