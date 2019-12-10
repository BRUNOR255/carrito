@extends('layouts.master')

@section('title')
Registrarse.Hogar en linea
@endsection

@section('content')
<div class="row">

  <div class="col-md-4 col-md-offset-4">
    <div class="thumbnail">
    <center><h1 style="font-family: monospace">Registrarse</h1></center>
    @if(count($errors) > 0)
    <div class="alert alert-danger">
      @foreach($errors->all() as $error)
        <p style="font-family: monospace">{{ $error }}</p>
      @endforeach
    </div>
    @endif
    <form class="{{ route('user.signup') }}" method="post">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-group">
        <label for="email" style="font-family: monospace">Correo: </label>
        <input type="text" id="email" name="email" class="form-control" style="font-family: monospace" required>
      </div>
      <div class="form-group">
        <label for="password" style="font-family: monospace">Contraseña: </label>
        <input type="password" id="password" name="password" class="form-control" style="font-family: monospace" required>
      </div>
      <div class="form-group">
        <input type="number" id="level" name="level" value="1" hidden>
      </div>
      <center><button type="submit" class="btn" style="background-color: #5D2D00; font-family: monospace; font-weight: 900; color:white;">Registrarse</button></center>
    </form>
    </div>
  </div>

</div>
@endsection
