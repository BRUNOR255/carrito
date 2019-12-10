@extends('layouts.master')

@section('content')
  <br>
  <div class="row">
    <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
      <div class="thumbnail">
        <center><h3 style="font-family: monospace; font-weight: 900"> Ingresar categoria </h3></center>
      <form class="" action="{{ route('categories.store') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="description" style="font-family: monospace; font-weight: 900">Descripcion: </label>
          <input type="text" name="description" class="form-control" id="description" placeholder="Ingresar Descripcion" style="font-family: monospace" required>
        </div>

        <center><button type="submit" class="btn" style="background-color: #5D2D00; font-family: monospace; font-weight: 900; color:white;">Ingresar</button></center>
      </form>
    </div>
  </div>
  </div>
  @endsection
