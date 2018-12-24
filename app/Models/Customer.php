<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
	protected $fillable = ['name','address','phone','propiter','areaId','others'];

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
					'address'=> 'required|max:250',
					'phone'=> 'required|regex:/(01)[0-9]{9}/|max:11',
					'propiter'=> 'required|max:250',
					'areaId'=> 'required|integer|exists:areas,id'
				];
			}
			default:break;
		}
	}

	public function area(){
		return $this->belongsTo('App\Models\Area','areaId');
	}


	public function invoices(){
		return $this->hasMany('App\Models\Invoice');
	}
	public function replaces(){
		return $this->hasMany('App\Models\Replace');
	}

	public function payments(){
		return $this->hasMany('App\Models\Payment');
	}

	public function getPreviousDueAttribute(){
	    $invoice_bills = $this->invoices()->sum('total_bill');
	    $all_payments = $this->payments()->sum('amount');


	    return $invoice_bills - $all_payments;

	    //return $invoice_bills - $all_payments - $replace_bills;
	}

	public function getTotalBillAttribute(){
		return $this->invoices()->sum('total_bill');
	}


	public function getTotalDepositAttribute(){
		return $this->payments()->sum('amount');
	}

	public function getTotalReplaceAttribute(){
		return $this->replaces()->sum('total_return_money');
	}

	public function getBalanceAttribute(){
		return ($this->getPreviousDueAttribute() * -1);
	}
	public function getDueAttribute(){
		return $this->getPreviousDueAttribute();
	}



}
