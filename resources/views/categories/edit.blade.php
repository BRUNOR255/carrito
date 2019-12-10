@extends('layouts.master')

@section('content')
<div class="row">
  <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
    <div class="thumbnail">
      <center><h3 style="font-family: monospace; font-weight: 900">Editar categoria</h3></center>
      <form class="" action="{{ route('categories.update',$category -> id) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-group">
          <label for="description" style="font-family: monospace; font-weight: 900">Descripcion:</label>
          <input type="text" name="description" class="form-control" id="description" style="font-family: monospace" value="{{ $category -> description}}">
        </div>

        <center><button type="submit" class="btn" style="background-color: #5D2D00; font-family: monospace; font-weight: 900; color:white;">Ingresar</button></center>
      </form>
    </div>
  </div>
  </div>
  @endsection
