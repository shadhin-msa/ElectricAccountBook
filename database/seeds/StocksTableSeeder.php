<?php

use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class StocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Stock::insert([
			[
				'id' => '1',
				'quantity'  => 10,
				'supplier' => 'supplier name',
				'product_id' => 2,
				'user_id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],[
				'id' => '2',
				'quantity'  => 7,
				'supplier' => 'sample name',
				'product_id' => 1,
				'user_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],[
				'id' => '3',
				'quantity'  => 15,
				'supplier' => 'sample name',
				'product_id' => 1,
				'user_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],[
				'id' => '4',
				'quantity'  => 27,
				'supplier' => 'sample name',
				'product_id' => 1,
				'user_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],[
				'id' => '5',
				'quantity'  => 1,
				'supplier' => 'sample name',
				'product_id' => 1,
				'user_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],[
				'id' => '6',
				'quantity'  => 7,
				'supplier' => 'sample name',
				'product_id' => 2,
				'user_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],[
				'id' => '7',
				'quantity'  => 6,
				'supplier' => 'sample name',
				'product_id' => 2,
				'user_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			]
		]);
    }
}
