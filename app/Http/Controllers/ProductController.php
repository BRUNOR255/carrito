<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\Order;
use App\category;
use Illuminate\Http\Request;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use Session;
use Auth;
use Image;
use Stripe\Charge;
use Stripe\Stripe;
use Carbon\Carbon;

class ProductController extends Controller
{
  public function imprimirPdf(Request $request)
  {
    if (Auth::user()->level==2)
    {
    $date = Carbon::now();
    $perrona = json_decode($request->oculto);
    $pdf = \PDF::loadView('Pdf',['datos'=>$perrona,'date'=>$date]);
     return $pdf->download('ejemplo.pdf');
    }
    else {
      return redirect('/');
    }
  }

  public function mostrarPdf(Request $request)
  {
    if (Auth::user()->level==2)
    {
    $date = Carbon::now();
    $perrona = json_decode($request->oculto);
    $pdf = \PDF::loadView('Pdf',['datos'=>$perrona,'date'=>$date]);
     return $pdf->stream('ejemplo.pdf');
    }
    else {
      return redirect('/');
    }
  }

  public function reporteExcel()
  {
    if (Auth::user()->level==2)
    {
    return view('Reportes');
    }
    else {
      return redirect('/');
    }
  }

  public function generarReporte(Request $request)
  {
    return Excel::download(new ProductExport($request->Inicio,$request->Fin), 'reporte.xlsx');
  }

  public function getIndex()
  {
    $products = Product::all();
    $categories = category::all();

    return view('shop.index', ['products'=>$products,'categories'=>$categories]);
  }

  public function getAddToCart(Request $request, $id)
  {
    $product = Product::find($id);
    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldCart);
    $cart->add($product, $product->id);

    $request->session()->put('cart', $cart);
    //dd($request->session()->get('cart'));
    return redirect()->route('product.index');
  }

  public function getReduceByOne($id)
  {
    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldCart);
    $cart->reduceByOne($id);

    if (count($cart->items) > 0)
    {
      Session::put('cart', $cart);
    }
    else
    {
      Session::forget('cart');
    }

    return redirect()->route('product.shoppingCart');
  }

  public function getRemoveItem($id)
  {
    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldCart);
    $cart->removeItem($id);

    if (count($cart->items) > 0)
    {
      Session::put('cart', $cart);
    }
    else
    {
      Session::forget('cart');
    }

    return redirect()->route('product.shoppingCart');
  }

  public function getCart()
  {
    if (!Session::has('cart'))
    {
      return view('shop.shopping-cart');
    }
    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);
    return view('shop.shopping-cart',['products'=>$cart->items,'totalPrice'=>$cart->totalPrice]);
  }

  public function getCheckout()
  {
    if (!Session::has('cart'))
    {
      return view('shop.shopping-cart');
    }
    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);
    $total = $cart->totalPrice;
    return view('shop.checkout',['total' => $total]);
  }

  public function postCheckout(Request $request)
  {
    if (!Session::has('cart'))
    {
      return redirect()->route('shop.shoppingCart');
    }
    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);

    Stripe::setApiKey('sk_test_NDknERkUrkrLAmxhw5m8HA4C00mkwsWdFN');
    try
    {
      $charge = Charge::create([
        "amount" => $cart->totalPrice * 100,
        "currency" => "usd",
        "source" => $request->input('stripeToken'), //obtained with Stripe.js
        "description" => "Test Charge"
      ]);
      $order = new Order();
      $order->cart = serialize($cart);
      $order->address = $request->input('address');
      $order->name = $request->input('name');
      $order->payment_id = $charge->id;
      $order->totalPrice=$cart->totalPrice;

      $carrito = $cart->items;

        $bandera = false;
        $title = "";

        foreach ($carrito as $producto)
        {
          $var1= $producto['qty'];
          $var2= $producto['item']['id'];
          $title = $producto['item']['title'];

          $articulo= Product::find($var2);
          if ($articulo->quantity < $var1)
          {
            $bandera = true;
          }
        }

        if($bandera == true)
        {
          return redirect()->route('checkout')
                          ->with('error','No hay existecia para el producto '.$title);
        }
        else
        {
          foreach ($carrito as $producto)
          {
            $var1= $producto['qty'];
            $var2= $producto['item']['id'];

            $articulo= Product::find($var2);

              $products = DB::table('products')
              ->where('products.id','=',$var2)
              ->decrement('products.quantity',$var1);
          }
          Auth::user()->orders()->save($order);
        }

    }
    catch (\Exception $e)
    {
      return redirect()->route('checkout')->with('error', $e->getMessage());
    }

    Session::forget('cart');
    return redirect()->route('product.index')->with('success', 'Successfully purchassed products!');
    }

    public function index()
    {
      if (Auth::user()->level==2)
      {
        $productos = Product::all();
        $categories = category::all();

        return view('Products.index',['productos'=>$productos,'categories'=>$categories]);
      }
      else
      {
        return redirect('/');
      }
    }

    public function create()
    {
      if (Auth::user()->level==2)
      {
        $categories = category::all();

        return view('Products.create',['categories'=>$categories]);
      }
      else
      {
        return redirect('/');
      }
    }

    protected function random_string()
   {
       $key = '';
       $keys = array_merge( range('a','z'), range(0,9) );

       for($i=0; $i<10; $i++)
       {
           $key .= $keys[array_rand($keys)];
       }

       return $key;
   }

   public function store(Request $request)
   {
     // ruta de las imagenes guardadas
       $ruta = public_path()."/img/";

       // recogida del form
       $imagenOriginal = $request->file('imagePath');

       // crear instancia de imagen
       $imagen = Image::make($imagenOriginal);

       // generar un nombre aleatorio para la imagen
       $temp_name = $this->random_string() . '.' . $imagenOriginal->getClientOriginalExtension();

       $imagen->resize(300,300);

       // guardar imagen
       // save( [ruta], [calidad])
       $imagen->save($ruta . $temp_name, 100);


       $personaje = new Product;
       $personaje->title = $request->title;
       $personaje->imagePath = $temp_name;
       $personaje->description = $request->description;
       $personaje->quantity = $request->quantity;
       $personaje->price = $request->price;
       $personaje->category_id = $request->category_id;
       $personaje->save();



       return redirect('/products');
   }

    public function show($id)
    {
        $productos = Product::find($id);
        $categories = category::all();

        return view('Products.edit',['productos'=>$productos,'categories'=>$categories]);
    }



    public function edit($id)
    {
      if (Auth::user()->level==2)
      {
       $product = Product::find($id);
       $categories = category::all();

      return view('Products.editI',['product'=>$product,'categories'=>$categories]);
      }
      else
      {
        return redirect('/');
      }
    }

    public function getEdit($id)
    {
      if (Auth::user()->level==2)
      {
       $product = Product::find($id);
       $categories = category::all();

      return view('Products.editT',['product'=>$product,'categories'=>$categories]);
      }
      else
      {
        return redirect('/');
      }
    }

    public function update(Request $request, $id)
    {
     // $data=$request->all();
     // Product::create($data);

     // ruta de las imagenes guardadas
      $ruta = public_path()."/img/";

      // recogida del form
      $imagenOriginal = $request->file('imagePath');

      // crear instancia de imagen
      $imagen = Image::make($imagenOriginal);

      // generar un nombre aleatorio para la imagen
      $temp_name = $this->random_string() . '.' . $imagenOriginal->getClientOriginalExtension();

      $imagen->resize(300,300);

      // guardar imagen
      // save( [ruta], [calidad])
      $imagen->save($ruta . $temp_name, 100);


      $personaje = Product::find($id);
      $personaje->title = $request->title;
      $personaje->imagePath = $temp_name;
      $personaje->description = $request->description;
      $personaje->quantity = $request->quantity;
      $personaje->price = $request->price;
      $personaje->category_id = $request->category_id;
      $personaje->update();

     return redirect('products');
    }

    public function destroy($id)
    {
     if (Auth::user()->level==2)
     {
       $vproduc = Product::find($id);
       $vproduc->destroy($id);

       return redirect('products');
     }
     else
     {
       return redirect('/');
     }
   }
}
