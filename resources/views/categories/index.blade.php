@extends('layouts.master')

@section('title')
  Hogar en linea
@endsection

@section('content')
<br>

<script type="text/javascript">

  function ConfirmDelete()
  {
    var x = confirm("¿SEGURO QUE DESEA ELIMINAR ESTA CATEGORIA?");
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

<center><a href="{{ route('categories.create')}}" class="btn" style="background-color: #78A333; font-family: monospace; font-weight: 900; color: white"><i class="material-icons md-18"> fiber_new </i> Crear categoria </a> </center>

<br>
<div class="row">
<div class="col-1">

</div>

<div class="col-10">
<table class="table table-dark" style="background-color: #ffff; font-family: monospace; font-weight: 900">
<thead >
  <tr>
    <th scope="col">SKU</th>
    <th scope="col">CATEGORIAS</th>
    <th scope="col">ACCIONES</th>
  </tr>
</thead>
<tbody style="background-color: #5D2D00; color: white; font-family: monospace; font-weight: 900">
  @foreach ($categories as $category)
    <tr>
      <td>{{$category->id}}</td>
      <td>{{$category->description}}</td>
      <td><a href="{{ url('/categories/'.$category->id.'/edit')}}" class="btn" style="background-color: #354CAB; font-family: monospace; font-weight: 900; color: white"><i class="material-icons md-18"> edit </i> EDITAR </a></td>
      <td><form action="{{ route('categories.destroy',$category -> id) }}" method="post" onsubmit="return ConfirmDelete();">
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

@endsection
