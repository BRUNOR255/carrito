@extends('layouts.master')

@section('title')
  Hogar en linea
@endsection

@section('content')
@if(Session::has('success'))
<div class="row">
  <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
    <div id="charge-message" class="alert alert-success">
      {{ Session::get('success') }}
    </div>
  </div>
</div>
@endif
@foreach ($products->chunk(3) as $productChunk)
<div class="row">
@foreach ($productChunk as $product)
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src=" img/{{$product->imagePath}} " alt="...">
      <div class="caption">
        <h4 style="font-family: monospace; font-weight: 900">{{$product->title}}</h4>
        <a href="{{ url('/products/'.$product->id)}}" class="btn" style="background-color: grey; font-family: monospace; font-weight: 900; color: white;" data-toggle="modal" data-id='{{$product->id}}' data-target="#informacion{{$product->id}}">+ del producto</a>
        <br>
        <p>
          <div class="clearfix">
            <div class="pull-left price " style="font-family: monospace; font-weight: 900"> {{$product->price}} </div>
            <br>
            <a href="{{ route('product.addToCart', ['$id' => $product->id]) }}" class="btn pull-right" role="button"  style="background-color: #5D2D00; font-family: monospace; font-weight: 900; color: white;">Agregar a carrito</a>
          </div>
        </p>
      </div>
    </div>
  </div>
@endforeach
</div>
<br>
@endforeach

@foreach ($products as $product)
    <div class="modal fade" id="informacion{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{$product->title}}:</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="font-family: monospace; font-weight: 900">
          <center><img src=" img/{{$product->imagePath}} " alt="200" width="200"></center>
          <br>
          Descripcion:
          <h5>{{ $product->description }}</h5>
          Precio:
          <h5>{{ $product->price }}</h5>
          Piezas en existencia:
          <h5>{{ $product->quantity }}</h5>
        </div>
        <div class="modal-footer">
          <a href="{{ route('product.addToCart', ['$id' => $product->id]) }}" class="btn" role="button"  style="background-color: #5D2D00; font-family: monospace; font-weight: 900; color: white;">Agregar a carrito</a>
          <button type="button" class="btn" style="background-color: #DA0213; font-family: monospace; font-weight: 900; color: white" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
    </div>
@endforeach
@endsection
