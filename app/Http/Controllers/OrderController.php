<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\category;
use Illuminate\Support\Facades\DB;
use Session;
use Auth;

class OrderController extends Controller
{
  public function index()
  {
    if (Auth::user()->level==2)
    {
      $orders=DB::table('orders')
      ->join('users','user_id','=','users.id')
      ->select('orders.id','orders.name','users.email','orders.totalPrice')
      ->simplePaginate(5);


      return view('orders.index',['orders'=>$orders]);
    }
    else
    {
      return redirect('/');
    }
  }

  public function destroy($id)
  {
    if (Auth::user()->level==2)
    {
      $vOrder = Order::find($id);
      $vOrder->destroy($id);

      return redirect('orders');
    }
    else
    {
      return redirect('/');
    }
  }
}
