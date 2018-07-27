<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delar extends Model
{
    protected $fillable = ['name','address','phone'];

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
					'phone'=> 'required|regex:/(01)[0-9]{9}/|max:11'
				];
			}
			default:break;
		}
	}
}
