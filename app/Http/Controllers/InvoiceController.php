<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::all();
        return view('admin_res.invoice.index', compact('invoices'));
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
        return view('admin_res.invoice.create', compact('customers','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,invoice::rules($request->method()));

        $payment_amount= (float)$request->payment;

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
        $invoice= new Invoice();

        $invoice->customer_id      =$request->customer_id;
        $invoice->subtotal         =$subtotal;
        $invoice->commission       =$request->commission;
        $invoice->total_commission = ($invoice->subtotal* $invoice->commission)/100;
        $invoice->total_bill       =$invoice->subtotal - $invoice->total_commission;
        $invoice->previous_due     =$customer->PreviousDue;
        $invoice->grand_total      =$invoice->total_bill+ $invoice->previous_due;
        $invoice->cash             =$request->payment;
        $invoice->current_due      =$invoice->grand_total - $invoice->cash;
        $invoice->user_id          =Auth()->user()->id;

        $invoice->save();

        for($i = 0; $i<count($array_products);$i++) {
            $i_pro = $array_products[$i];
            $p= $invoice->products()->attach([
                $i_pro['product_id'] =>['price'=>$i_pro['price'], 'quantity'=>$i_pro['quantity'], 'total'=>$i_pro['total']]]);
            Product::find( $i_pro['product_id'])->calculateStock();
        }

        $pament_reason = "Invoice payment";

        $p= $invoice->payment()->create(['amount'=> $payment_amount, 'customer_id'=>$invoice->customer_id, 'remark'=> '', 'reason'=> $pament_reason]);
        $invoice->payment_id = $p->id;
        $invoice->save();

        $i = Invoice::find($invoice->id);
        
        /*
                      fall back: custom quantity check validation

         */
        
        $request->session()->flash('alert-success', 'Data added successfully!');

        return redirect(route('invoice.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        return view('admin_res.invoice.show',compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }

    public function chalan(Invoice $invoice)
    {
        return view('admin_res.invoice.chalan',compact('invoice'));
    }
}
