<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('login');
    }
   
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
       $stocks = stock::all();
       $products = Product::all();
       return view('admin_res.stock',compact('stocks','products'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {

       return $this->index();
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {

       $this->validate($request,stock::rules($request->method()));
       Auth::user()->stocks()->create($request->all());
       $product = Product::find($request->product_id);
       $product->calculateStock();

       $request->session()->flash('alert-success', 'Data added successfully!');
       return redirect(route('stock.index'));
   }

   /**
    * Display the specified resource.
    *
    * @param  \App\Models\stock  $stock
    * @return \Illuminate\Http\Response
    */
   public function show(stock $stock)
   {
       return $this->index();
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\stock  $stock
    * @return \Illuminate\Http\Response
    */
   public function edit(stock $stock)
   {     
       $products = Product::all();
       $stocks= stock::all();
       return view('admin_res.stock', compact(['stock','stocks','products']));
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\stock  $stock
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, stock $stock)
   {
       $this->validate($request,stock::rules($request->method()));

       $old_product = $stock->product;

       $stock->update($request->all());
       $stock->user_id= Auth::user()->id ;
       $stock->save();

       $current_product = Product::find($request->product_id);
       $current_product->calculateStock();

       //update old product if stock product changed
       if($current_product->id != $old_product->id){
            $old_product->calculateStock();
       }

       $request->session()->flash('alert-success', 'Data Updated successfully!');
       return redirect(route('stock.index'));
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\stock  $stock
    * @return \Illuminate\Http\Response
    */
   public function destroy(stock $stock)
   {
       $product = $stock->product;
       $stock->delete();
       $product->calculateStock();

       return redirect()->route('stock.index')->with('alert-success', 'Data Deleted!');
   }
}
