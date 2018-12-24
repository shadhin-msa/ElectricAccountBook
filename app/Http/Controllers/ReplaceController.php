<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Replace;
use App\Models\Product;
use Illuminate\Http\Request;

class ReplaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $replaces = Replace::orderBy('created_at','DESC')->get();
        return view('admin_res.replace.index', compact('replaces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('admin_res.replace.create', compact('customers','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,replace::rules($request->method()));

        $subtotal = 0;
        $array_products=[];
        //calculate all item total
        $c = count($request->product_id);
        for($i=0; $i < $c; $i++) {
            $array_products[$i]['product_id'] = (int)$request->product_id[$i];
            $array_products[$i]['price'] = (float)$request->price[$i];
            $array_products[$i]['quantity'] = (int)$request->quantity[$i];
            $array_products[$i]['total'] = $array_products[$i]['price'] * $array_products[$i]['quantity'];

            $subtotal += $array_products[$i]['total'];
        }


        $customer = Customer::find($request->customer_id);
        $user = Auth()->user();
        $replace= new Replace();


        $replace->customer_id        =$request->customer_id;
        $replace->subtotal           =$subtotal;
        $replace->commission         =$request->commission;
        $replace->total_commission   = (abs($replace->subtotal)* $replace->commission)/100;
        $replace->total_return_money =$replace->subtotal - $replace->total_commission;
        $replace->previous_due       =$customer->PreviousDue;
        $replace->current_due        =$replace->previous_due - $replace->total_return_money;
        $replace->user_id            =$user->id;

        /*........add payment entry.............*/



        $pament_reason = "Replace money deposit";
        //adding prodct details in payment description 
        $description = "";
        $c = count($array_products);
        for($i=0; $i < $c; $i++) {
            $description .= Product::find($array_products[$i]['product_id'])->name."( x ". $array_products[$i]['quantity'].") ,";
        }
        $payment_amount = $replace->total_return_money;
        $p= $user->payments()->create(['amount'=> $payment_amount, 'customer_id'=>$replace->customer_id, 'remark'=> 'Cash returned for replacing ['.$description.']', 'reason'=> $pament_reason]);
        
        $replace->payment_id = $p->id;
        $replace->save();

        for($i = 0; $i<count($array_products);$i++) {
            $i_pro = $array_products[$i];
            $p= $replace->products()->attach([
                $i_pro['product_id'] =>['price'=>$i_pro['price'], 'quantity'=>$i_pro['quantity'], 'total'=>$i_pro['total']]]);
            Product::find( $i_pro['product_id'])->calculateStock();
        }


        $i = Replace::find($replace->id);
        
        /*
                      fall back: custom quantity check validation

         */
        
        $request->session()->flash('alert-success', 'Data added successfully!');

        return redirect(route('replace.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Replace  $replace
     * @return \Illuminate\Http\Response
     */
    public function show(Replace $replace)
    {
        return view('admin_res.replace.show',compact('replace'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Replace  $replace
     * @return \Illuminate\Http\Response
     */
    public function edit(Replace $replace)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Replace  $replace
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Replace $replace)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Replace  $replace
     * @return \Illuminate\Http\Response
     */
    public function destroy(Replace $replace)
    {
        //
    }

}
