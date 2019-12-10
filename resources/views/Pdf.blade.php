<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <script src="script.js"></script>
    </head>
    <style media="screen">
    @page{
          size: 250px 1250px;
        }

        * {
         font-size: 12px;
         font-family: monospace;
        }

      td,th,tr,table {
        border-top: 1px solid black;
        border-collapse: collapse;
      }

      td.producto,th.producto {
          width: 75px;
          max-width: 75px;
        }

      td.cantidad,th.cantidad {
        width: 40px;
        max-width: 40px;
        word-break: break-all;
      }

      td.precio,th.precio {
        width: 40px;
        max-width: 40px;
        word-break: break-all;
      }

      .centrado {
        text-align: center;
        align-content: center;
      }

      .ticket {
        width: 155px;
        max-width: 155px;
      }

      img {
        max-width: inherit;
        width: inherit;
      }
      </style>
    <body>
      <?php
     $articulos=$datos->cart->items;
      ?>
        <div class="ticket">
          <center><h1>Muebles "TURRIS"</h1></center>
            <img src="https://www.barkerandstonehouse.co.uk/images/swatchzoom/3HOU3STRBULK-WYATT-RANCH.jpg" alt="Logotipo">

            <p class="centrado">
              TICKET #{{ $datos->id}}
              <br>
              Blvd. Agua Caliente #11999, Hipodromo, 22000 Tijuana, B.C.
              <br>
              {{$date = $date->format('d-m-Y h:m:s')}}
            </p>
            <div class="col-10">
            <table class="table table-dark" style="font-family: monospace;">
            <thead>
              <tr>
                  <th>ID</th>
                  <th>|CANT</th>
                  <th>|PRODUCTO</th>
                  <th>|$.$</th>
              </tr>
            </thead>
            <tbody style=" font-family: monospace; text-align: justify">
              @foreach($articulos as $item)
                <tr>
                    <td>{{$item->item->id}}</td>
                    <td>{{$item->qty}}</td>
                    <td>{{$item->item->title}}</td>
                    <td>{{$item->price}}</td>
                </tr>
                <tr>
                  <td colspan="4">{{$item->item->description}}</td>
                </tr>
                @endforeach
            </tbody>
            </table>
            </div>
            <br>
            Precio Final: {{$datos->cart->  totalPrice}}
            <br>
            <p class="centrado">¡GRACIAS POR SU PREFERECIA!</p>
</html>
