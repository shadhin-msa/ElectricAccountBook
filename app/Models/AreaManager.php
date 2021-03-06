<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaManager extends Model
{
    
	protected $fillable = ['name','address','phone','areaId'];

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
					'areaId'=> 'required|integer|exists:areas,id'
				];
			}
			default:break;
		}
	}
		public function area(){
		return $this->belongsTo('App\Models\Area','areaId');
	}
}
