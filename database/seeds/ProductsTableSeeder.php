<?php

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
              
    	Product::insert([
			[
				'id' => '1',
				'name'  => 'gazi pipe',
				'categoryId' => 1,
				'perunit' => 10, 
				'description' => "Lorem ipsum is placeholder text commonly used in the graphic, print, 
										and publishing industries for previewing layouts and visual mockups.", 
				'stock' => 0,
				'price' => 112.4,
 				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
 				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],[
				'id' => '2',
				'name'  => 'Gazi motor',
				'categoryId' => 1,
				'perunit' => 10, 
				'description' => "Lorem ipsum is placeholder text commonly used in the graphic, print, 
										and publishing industries for previewing layouts and visual mockups.", 
				'stock' => 0,
				'price' => 10.24 ,
 				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
 				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],[
				'id' => '3',
				'name'  => 'Tin',
				'categoryId' => 1,
				'perunit' => 1, 
				'description' => "Lorem ipsum is placeholder text commonly used in the graphic, print, 
										and publishing industries for previewing layouts and visual mockups.", 
				'stock' => 0,
				'price' => 34.00 ,
 				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
 				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],[
				'id' => '4',
				'name'  => 'belal Pipe ',
				'categoryId' => 1,
				'perunit' => 1, 
				'description' => "Lorem ipsum is placeholder text commonly used in the graphic, print, 
										and publishing industries for previewing layouts and visual mockups.", 
				'stock' => 0,
				'price' => 67.03 ,
 				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
 				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			]
		]);
    }
}
