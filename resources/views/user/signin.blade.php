@extends('layouts.master')

@section('title')
@endsection

@section('content')
<div class="row">
  <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
    <div class="thumbnail">
    <center><h1 style="font-family: monospace">Iniciar sesion</h1></center>
    @if(count($errors) > 0)
    <div class="alert alert-danger">
      @foreach($errors->all() as $error)
        <p style="font-family: monospace; font-weight: 900">{{ $error }}</p>
      @endforeach
    </div>
    @endif
    <form class="{{ route('user.signin') }}" method="post">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-group">
        <label for="email" style="font-family: monospace; font-weight: 900">Correo: </label>
        <input type="text" id="email" name="email" class="form-control" style="font-family: monospace; font-weight: 900" required>
      </div>
      <div class="form-group">
        <label for="password" style="font-family: monospace; font-weight: 900">Contraseña: </label>
        <input type="password" id="password" name="password" class="form-control" style="font-family: monospace; font-weight: 900" required>
      </div>
      <div class="col-xs-12">
      <center><button type="submit" class="btn" style="background-color: #5D2D00; font-family: monospace; font-weight: 900; color:white;">Entrar</button></center>
      </div>
    </form>
    <p style="font-family: monospace; font-weight: 900">No tienes cuenta? <a href="{{ route('user.signup') }}" style="font-family: monospace; font-weight: 900">Registrate</a> </p>
    </div>
  </div>
</div>
@endsection
