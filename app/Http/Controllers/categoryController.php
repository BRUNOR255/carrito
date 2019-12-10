<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\category;
use App\Cart;
use Session;
use Auth;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
      if (Auth::user()->level==2)
      {
        $categories = category::all();

        return view('categories.index',['categories'=>$categories]);
      }
      else
      {
        return redirect('/');
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if (Auth::user()->level==2)
      {
        return view('categories.create');
      }
      else
      {
        return redirect('/');
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $data=$request->all();
      category::create($data);

      return redirect('categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
     {
       if (Auth::user()->level==2)
       {
         $category = category::find($id);
         return view('categories.edit',['category'=>$category]);
       }
       else
       {
         return redirect('/');
       }
     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, $id)
     {
       $vcategory = category::find($id);
       $data= $request->all();

       $vcategory->update($data);
       return redirect('categories');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
       if (Auth::user()->level==2)
       {
         $vcategory = category::find($id);
         $vcategory->destroy($id);

         return redirect('categories');
       }
       else
       {
         return redirect('/');
       }
     }
}
