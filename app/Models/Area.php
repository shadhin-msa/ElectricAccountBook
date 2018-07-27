<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = ['name','description'];

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
					'description'=> 'required|max:250'
				];
				
			}
			default:break;
		}
	}
}
