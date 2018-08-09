<?php

namespace App\Models;

use App\Rules\Quantity;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
	public static function rules($method)
	{

		switch($method)
		{
			case 'GET':
			case 'DELETE':
			{
				return [];
			}
			case 'POST':
			case 'PUT':
			case 'PATCH':
			{
				return [
					'customer_id'=> 'required|integer|exists:customers,id',
					'commission'=> 'required|min:0|regex:/^\d*(\.\d{1,2})?$/',
					'payment'=> 'required|min:0|regex:/^\d*(\.\d{1,2})?$/',
					'product_id' =>'required|array|min:1',
					'product_id.*' =>'required|integer|exists:products,id|distinct',
					'quantity' =>['required','array','min:1',new Quantity],
					'quantity.*' =>['required','integer','min:1'],
					'price' =>'required|array|min:1',
					'price.*' =>'required|min:0|regex:/^\d*(\.\d{1,2})?$/',
				];
			}
			default:break;
		}
	}

    public function products()
    {
    	return $this->belongsToMany('App\Models\Product','invoice_products')->withPivot('price','quantity','total');
    }

    public function payment()
    {
    	return $this->belongsTo('App\Models\Payment');
    }
}
