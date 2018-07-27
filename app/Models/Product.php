<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','categoryId','perunit','price','description'];

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
					'name'=> 'required|max:100',
					'categoryId'=> 'required|integer|exists:categories,id',
					'perunit'=> 'required|integer',
					'price'=> 'required|regex:/^\d*(\.\d{1,2})?$/',
					'description'=> 'required|max:500',
				];
			}
			default:break;
		}
	}


	public function category(){
		return $this->belongsTo('App\Models\Category','categoryId');
	}

	public function calculateStock(){
		$total_stock = Stock::where('product_id', $this->id)->sum('quantity');
		$this->stock = $total_stock;
		$this->save();
		return true;
	}
}
