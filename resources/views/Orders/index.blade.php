@extends('layouts.master')

@section('title')
  Hogar en linea
@endsection

@section('content')
<script type="text/javascript">

  function ConfirmDelete()
  {
    var x = confirm("¿SEGURO QUE DESEA ELIMINAR ESTA ORDEN?");
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

<br>
<div class="row">
<div class="col-1">

</div>

<div class="col-10">
<table class="table table-dark" style="background-color: #ffff; font-family: monospace; font-weight: 900">
<thead >
  <tr>
    <th scope="col">Compra</th>
    <th scope="col">Cliente</th>
    <th scope="col">Correo</th>
    <th scope="col">Precio Total</th>
    <th scope="col">ACCIONES</th>
  </tr>
</thead>
<tbody style="background-color: #5D2D00; color: white; font-family: monospace; font-weight: 900">
  @foreach ($orders as $order)
    <tr>
      <td>{{$order->id}}</td>
      <td>{{$order->name}}</td>
      <td>{{$order->email}}</td>
      <td>{{$order->totalPrice}}</td>
      <td><form action="{{ route('orders.destroy',$order -> id) }}" method="post" onsubmit="return ConfirmDelete();">
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
{{ $orders->links() }}
@endsection
