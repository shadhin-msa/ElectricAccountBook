<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Replace extends Model
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
					// 'payment'=> 'required|min:0|regex:/^\d*(\.\d{1,2})?$/',
					'product_id' =>'required|array|min:1',
					'product_id.*' =>'required|integer|exists:products,id|distinct',
					'quantity' =>['required','array','min:1'],
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
    	return $this->belongsToMany('App\Models\Product','replace_products')->withPivot('price','quantity','total');
    }

    public function customer()
    {
    	return $this->belongsTo('App\Models\Customer');
    }


    public function payment()
    {
    	return $this->belongsTo('App\Models\Payment');
    }
}
