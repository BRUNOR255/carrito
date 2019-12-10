@extends('layouts.master')

@section('content')
  <br>
  <div class="row">
    <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
      <div class="thumbnail">
        <center><h3 style="font-family: monospace; font-weight: 900"> Ingresar producto </h3></center>
      <form class="" action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="imagePath" style="font-family: monospace; font-weight: 900">Producto: </label>
          <input type="file" name="imagePath" class="form-control" id="imagePath" style="font-family: monospace">
        </div>
        <div class="form-group">
          <label for="title" style="font-family: monospace; font-weight: 900">Titulo: </label>
          <input type="text" name="title" class="form-control" id="title" placeholder="Ingresar Titulo" style="font-family: monospace" required>
        </div>
        <div class="form-group">
          <label for="description" style="font-family: monospace; font-weight: 900">Descripcion: </label>
          <input type="text" name="description" class="form-control" id="description" placeholder="Ingresar Descripcion" style="font-family: monospace" required>
        </div>
        <div class="form-group">
          <label for="price" style="font-family: monospace; font-weight: 900">Precio: </label>
          <input type="decimal" name="price" class="form-control" id="price" placeholder="Ingresar Precio" style="font-family: monospace" required>
        </div>
        <div class="form-group">
          <label for="quantity" style="font-family: monospace; font-weight: 900">Cantidad: </label>
          <input type="number" name="quantity" class="form-control" id="quantity" placeholder="Ingresar Cantidad" style="font-family: monospace" required>
        </div>
        <div class="form-group">
        <label for="category_id" style="font-family: monospace; font-weight: 900">Categoria: </label>
        <select class="form-group" id="category_id" name="category_id" style="font-family: monospace" required>
          @foreach($categories as $category)
          <option value="{{ $category->id }}" style="font-family: monospace">{{ $category->description }}</option>
          @endforeach
        </select>
        </div>

        <center><button type="submit" class="btn" style="background-color: #5D2D00; font-family: monospace; font-weight: 900; color:white;">Ingresar</button></center>
      </form>
    </div>
  </div>
  </div>
  @endsection
