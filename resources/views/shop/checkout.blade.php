@extends('layouts.master')

@section('title')
  Hogar en linea
@endsection

@section('content')
<div class="row">
  <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
    <div class="thumbnail">
    <center><h4 style="font-family: monospace; font-weight: 900">Checkout</h4></center>
    <h5 style="font-family: monospace; font-weight: 900">Total a pagar: ${{ $total }}</h5>
    <div id="charge-error" class="alert alert-danger {{ !Session::has('error') ? 'hidden' : '' }}">
      {{ Session::get('error') }}
    </div>
    <form action="{{ route('checkout') }}" method="post" id="checkout-form">
      <div class="row">
        <div class="col-xs-12">
          <div class="form-group">
            <label for="name" style="font-family: monospace; font-weight: 900">Nombre:</label>
            <input type="text" id="name" class="form-control" name="name" style="font-family: monospace; font-weight: 900" required>
          </div>
        </div>
        <div class="col-xs-12">
          <div class="form-group">
            <label for="address" style="font-family: monospace; font-weight: 900">direccion:</label>
            <input type="text" id="address" class="form-control" name="address" style="font-family: monospace; font-weight: 900" required>
          </div>
        </div>
        <div class="col-xs-12">
          <div class="form-group">
            <label for="card-name" style="font-family: monospace; font-weight: 900">Portador de tarjeta:</label>
            <input type="text" id="card-name" class="form-control" style="font-family: monospace; font-weight: 900" required>
          </div>
        </div>
        <div class="col-xs-12">
          <div class="form-group">
            <label for="card-number" style="font-family: monospace; font-weight: 900">Numero de tarjeta:</label>
            <input type="text" id="card-number" class="form-control" style="font-family: monospace; font-weight: 900" required>
          </div>
        </div>
        <div class="col-xs-6">
          <div class="form-group">
            <label for="card-expiry-month" style="font-family: monospace; font-weight: 900">Mes de expiracion:</label>
            <input type="text" id="card-expiry-month" class="form-control" style="font-family: monospace; font-weight: 900" required>
          </div>
        </div>
        <div class="col-xs-6">
          <div class="form-group">
            <label for="card-expiry-year" style="font-family: monospace; font-weight: 900">Año de expiracion:</label>
            <input type="text" id="card-expiry-year" class="form-control" style="font-family: monospace; font-weight: 900" required>
          </div>
        </div>
        <div class="col-xs-12">
          <div class="form-group">
            <label for="card-cvc" style="font-family: monospace; font-weight: 900">CVC:</label>
            <input type="text" id="card-cvc" class="form-control" style="font-family: monospace; font-weight: 900" required>
          </div>
        </div>
        {{ csrf_field() }}
        <div class="col-xs-12">
        <center><button type="submit" class="btn" style="background-color: #5D2D00; font-family: monospace; font-weight: 900; color:white;">Realizar compra</button></center>
        </div>
    </form>
    </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
  <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  <script type="text/javascript" src="{{ URL::to('js/checkout.js') }}"></script>
@endsection
