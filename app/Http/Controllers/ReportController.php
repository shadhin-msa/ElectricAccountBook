<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
 
class ReportController extends Controller
{
    public function due(){
    	$customers = customer::all();
    	return view('admin_res.report.due', compact('customers'));
    }
    public function sale(){

        $invoices = invoice::all();
        return view('admin_res.report.sale', compact('invoices'));
    }
    public function customer_index(){
        $customers = Customer::all();
        return view('admin_res.report.customer', compact('customers'));
    }

    public function customer(Request $request)
    {
        // dd($request);
       $validateData =  $request->validate([
                            'customer_id'=> 'required|max:100',
                            'start_date'=> 'required| date',
                            'end_date'=> 'required| date | after:start_date '
                        ]);
        
        $customers = Customer::all();
        $customer = Customer::find($request['customer_id']);
        $start_date = $request['start_date'];
        $end_date = $request['end_date'];
        $end_date_plus1 = date('Y/m/d', strtotime($end_date.'+1 day') );

        // dd($end_date."   ".$end_date_plus1);
        $invoices = $customer->invoices()->whereBetween('created_at', [$start_date , $end_date_plus1])->get();
        $payments = $customer->payments()->whereBetween('created_at', [$start_date , $end_date_plus1])->get();
        return view('admin_res.report.customer', compact('customers','customer','start_date', 'end_date', 'invoices', 'payments'));
    }

    public function stock_index(){
        $products = Product::all();
        return view('admin_res.report.stock', compact('products'));
    }

    public function stock(Request $request)
    {
        // dd($request);
       $validateData =  $request->validate([
                            'product_id'=> 'required|max:100',
                            'start_date'=> 'required| date',
                            'end_date'=> 'required| date | after:start_date '
                        ]);
        
        $products = product::all();
        $product = product::find($request['product_id']);
        $start_date = $request['start_date'];
        $end_date = $request['end_date'];
        $end_date_plus1 = date('Y/m/d', strtotime($end_date.'+1 day') );

        // dd($end_date."   ".$end_date_plus1);
        $invoices = $product->invoices()->whereBetween('invoices.created_at', [$start_date , $end_date_plus1])->get();
        $stocks = $product->stocks()->whereBetween('created_at', [$start_date , $end_date_plus1])->get();
        $replaces = $product->replaces()->whereBetween('replaces.created_at', [$start_date , $end_date_plus1])->get();


        
        $sale_quantity= 0;
        foreach ($invoices as  $invoice) {
            $sale_quantity+= $invoice->pivot->quantity;
        }

        $purchase_quantity = 0;

        foreach ($stocks as  $stock) {
            $purchase_quantity += $stock->quantity;
        }
        $replace_quantity= 0;
        foreach ($replaces as  $replace) {
            $replace_quantity += $replace->pivot->quantity;
        }
        return view('admin_res.report.stock', compact('products','product','start_date', 'end_date', 'invoices', 'stocks','sale_quantity', 'purchase_quantity','replace_quantity'));
    }


    public function area(){


    	return "area report";
    	
    }
}
