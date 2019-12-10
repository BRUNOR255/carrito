@extends('layouts.master')

@section('title')
  Hogar en linea
@endsection

@section('content')
<br>

<script type="text/javascript">

  function ConfirmDelete()
  {
    var x = confirm("¿SEGURO QUE DESEA ELIMINAR ESTE PRODUCTO?");
    if (x)
    {
      return true;
    }
    else
    {
      return false;
    }
  }

</script>

<center><a href="{{ route('products.create')}}" class="btn" style="background-color: #78A333; font-family: monospace; font-weight: 900; color: white"><i class="material-icons md-18"> fiber_new </i> Crear producto </a> </center>

<br>
<div class="row">
<div class="col-1">

</div>

<div class="col-10">
<table class="table table-dark" style="background-color: #ffff; font-family: monospace; font-weight: 900">
<thead>
  <tr>
    <th scope="col">SKU</th>
    <th scope="col">PRODUCTO</th>
    <th scope="col">PRECIO</th>
    <th scope="col">CANTIDAD</th>
    <th scope="col">ACCIONES</th>
  </tr>
</thead>
<tbody style="background-color: #5D2D00; color: white; font-family: monospace; font-weight: 900">
  @foreach ($productos as $producto)
    <tr>
      <td>{{$producto->id}}</td>
      <td><img src=" img/{{$producto->imagePath}} " alt="50" width="50">
          {{$producto->title}}</td>
      <td>{{$producto->price}}</td>
      <td><a href="{{ url('/products/'.$producto->id.'/edit')}}" class="btn" style="background-color: #354CAB; font-family: monospace; font-weight: 900; color: white"><i class="material-icons md-18">edit</i> EDITAR </a></td>
      <td><a href="{{ url('/products/'.$producto->id)}}" class="btn" style="background-color: #6D2A9E; font-family: monospace; font-weight: 900; color: white" data-toggle="modal" data-id='{{$producto->id}}' data-target="#informacion{{$producto->id}}"><i class="material-icons md-18"> description </i>Mostrar+</a></td>
      <td><form action="{{ route('products.destroy',$producto -> id) }}" method="post" onsubmit="return ConfirmDelete();">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button type="submit" name="button" class="btn" style="background-color: #DA0213; font-family: monospace; font-weight: 900; color: white"><i class="material-icons md-18"> delete </i> ELIMINAR </a></button>
      </form></td>
    </tr>
  @endforeach
</tbody>
</table>
</div>
</div>

@foreach ($productos as $producto)
    <div class="modal fade" id="informacion{{$producto->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{$producto->title}}:</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="font-family: monospace; font-weight: 900">
          <center><img src=" img/{{$producto->imagePath}} " alt="200" width="200"></center>
          <br>
          Descripcion:
          <h5>{{ $producto->description }}</h5>
          Precio:
          <h5>{{ $producto->price }}</h5>
          Existencia:
          <h5>{{ $producto->quantity }}</h5>
          Categoria:
          @foreach ($categories as $category)
          @if($category['id'] == $producto['category_id'])
          <h5>{{$category->description}}</h5>
          @endif
          @endforeach
        </div>
        <div class="modal-footer">
          <button type="button" class="btn" style="background-color: #DA0213; font-family: monospace; font-weight: 900; color: white" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
    </div>
@endforeach
@endsection
