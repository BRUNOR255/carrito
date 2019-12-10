@extends('layouts.master')

@section('title')
@endsection

@section('content')
<div class="row">

  <div class="col-md-5 col-md-offset-4">
    <div class="thumbnail">
    <center>
    <h1 style="font-family: monospace; font-weight: 900">Perfil de Usuario</h1>
    <h2 style="font-family: monospace; font-weight: 900">Mis ordenes</h2>
    @foreach($orders as $order)
    <div class="panel panel-default">
      <div class="panel-body">
        <ul class="list-group">
          @foreach($order->cart->items as $item)
          <li class="list-group-item" style="font-family: monospace; font-weight: 900">
            <span class="badge" style="font-family: monospace; font-weight: 900">${{ $item['price'] }}</span>
            {{ $item['item']['title'] }} | {{ $item['qty'] }} Units
          </li>
          @endforeach
        </ul>
        <form class="" target="_blank" action="{{ route('productoss.pdf')}}" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="oculto" value="{{ $order }}">
          <button type="submit" name="button" class="btn pull-left" style="background-color: #5D2D00; font-family: monospace; font-weight: 900; color:white;">Mostrar</button>
        </form>
        <form class="" action="{{ route('productos.pdf')}}" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="oculto" value="{{ $order }}">
          <button type="submit" name="button" class="btn pull-right" style="background-color: #5D2D00; font-family: monospace; font-weight: 900; color:white;">Imprimir</button>
        </form>
      </div>
      <div class="panel-footer">
        <strong style="font-family: monospace; font-weight: 900">Precio total: ${{ $order->cart->totalPrice }}</strong>
      </div>
    </div>
    @endforeach
    </center>
    </div>
  </div>
</div>

@endsection
