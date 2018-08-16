<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	// public function __construct(array $attributes = array()){

	//     parent::__construct($attributes);
	//     	dd($attributes);
	// }
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
	public function invoices(){
		return $this->belongsToMany('App\Models\Invoice','invoice_products')->withPivot('price','quantity','total');
	}
	public function replaces(){
		return $this->belongsToMany('App\Models\Replace','replace_products')->withPivot('price','quantity','total');
	}

	public function calculateStock(){
		
		$stock = Stock::where('product_id', $this->id)->sum('quantity');
		$sell = $this->invoices()->sum('quantity');
		$replace = $this->replaces()->sum('quantity');
		$current_stock = $stock - $sell + $replace;
		// dd("stock ".$stock."/ sell ".$sell." / replace".$replace." / current ".$current_stock);
		$this->stock = $current_stock;
		$this->save();
		return $current_stock;
	}

	public function getStockAttribute($value){
		$stock = $value;
		if($stock < 1){
			return $this->calculateStock();
		}else{
			return $stock;
		}
	}
}
