<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
	protected $fillable = ['quantity','supplier','product_id'];

     //get validation rules
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
					'quantity'=> 'required|integer|min:1',
					'supplier'=> 'required|max:150',
					'product_id'=> 'required|integer|exists:products,id'
				];
			}
			default:break;
		}
	}

	public function product(){
		return $this->belongsTo('App\Models\Product','product_id');
	}

	public function user(){
		return $this->belongsTo('App\User','user_id');
	}
}
