@extends('layouts.master')

@section('title')
  Shopping cart
@endsection

@section('content')
  @if(Session::has('cart'))
    <div class="row">
      <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
        <ul class="list-group">
          @foreach($products as $product)
            <li class="list-group-item">
              <span class="badge" style="font-family: monospace; font-weight: 900">{{ $product['qty'] }}</span>
              <strong style="color: black; font-family: monospace; font-weight: 900">{{ $product['item']['title'] }}</strong>
              <span class="label label-success" style="color: black; font-family: monospace; font-weight: 900">{{ $product['price'] }}</span>
              <div class="btn-group">
                <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown"> Accion <span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <li><a href="{{ route('product.reduceByOne', ['id'=>$product['item']['id']]) }}">Reducir 1</a></li>
                  <li><a href="{{ route('product.remove', ['id'=>$product['item']['id']]) }}">Descartar</a></li>
                </ul>
              </div>
            </li>
          @endforeach
        </ul>
    </div>
    </div>
    <div class="row">
      <div class="col-sm-2 col-md-2 col-md-offset-3 col-sm-offset-3">
        <div class="thumbnail">
        <strong style="color: black; font-family: monospace; font-weight: 900">Total: ${{ $totalPrice }}</strong>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
        <a href="{{ route('checkout') }}" type="button" class="btn" style="background-color: #5D2D00; font-family: monospace; font-weight: 900; color:white;">Checkout</a>
      </div>
    </div>
  @else
  <div class="row">
    <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
      <h2>No Items in Cart</h2>
    </div>
  </div>
  @endif
@endsection
