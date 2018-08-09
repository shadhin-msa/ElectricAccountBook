<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
      
	protected $fillable = ['amount','customer_id','remark', 'reason'];

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
					'amount'=> 'required|numeric',
					'remark'=> 'max:250',
					'customer_id'=> 'required|integer|exists:customers,id'
				];
			}
			default:break;
		}
	}

	public function customer(){
		return $this->belongsTo('App\Models\Customer');
	}
	
	public function user(){
		return $this->belongsTo('App\User');
	}

}
