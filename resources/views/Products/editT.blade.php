@extends('layouts.master')

@section('content')
<div class="row">
  <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
    <div class="thumbnail">
      <center><h3 style="font-family: monospace; font-weight: 900">Editar producto</h3></center>
      <form class="" action="{{ route('products.update',$product->id) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-group">
          <label for="title" style="font-family: monospace; font-weight: 900">Titulo:</label>
          <input type="text" name="title" class="form-control" id="title" style="font-family: monospace" value="{{ $product -> title}}">
        </div>
        <div class="form-group">
          <label for="imagePath" style="font-family: monospace; font-weight: 900">Producto:</label>
          <input type="text" name="imagePath" class="form-control" id="imagePath" style="font-family: monospace" value="{{$product->imagePath}}">
        </div>
        <div class="form-group">
          <label for="description" style="font-family: monospace; font-weight: 900">Descripcion:</label>
          <input type="text" name="description" class="form-control" id="description" style="font-family: monospace" value="{{ $product -> description}}">
        </div>
        <div class="form-group">
          <label for="price" style="font-family: monospace; font-weight: 900">Precio:</label>
          <input type="decimal" name="price" class="form-control" id="price" style="font-family: monospace" value="{{ $product -> price}}">
        </div>
        <div class="form-group">
          <label for="quantity" style="font-family: monospace; font-weight: 900">Cantidad:</label>
          <input type="number" name="quantity" class="form-control" id="quantity" style="font-family: monospace" value="{{ $product -> quantity}}">
        </div>
        <div class="form-group">
        <label for="category_id" style="font-family: monospace; font-weight: 900">Categoria:</label>
        <select class="form-control" name="category_id" id="category_id">
          @foreach ($categories as $category)
          @if($category['id'] == $product['category_id'])
          <option value="<?php echo $category['id'];?>" style="font-family: monospace" selected><?php echo $category['description'];?></option>
          @else
          <option value="<?php echo $category['id'];?>" style="font-family: monospace"><?php echo $category['description'];?></option>
          @endif
          @endforeach
        </select>
        </div>

        <center><button type="submit" class="btn" style="background-color: #5D2D00; font-family: monospace; font-weight: 900; color:white;">Ingresar</button></center>
      </form>
    </div>
  </div>
  </div>
  @endsection
