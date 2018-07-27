<?php

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	Category::insert([
			[
				'id' => '1',
				'name'  => 'Pipe',
				'unit_type' => '2',
 				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
 				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],[
				'id' => '2',
				'name'  => 'Sample Category',
				'unit_type' => '1',
 				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
 				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],[
				'id' => '3',
				'name'  => '2nd Sample Category',
				'unit_type' => '2',
 				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
 				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			]
		]);
    }
}
