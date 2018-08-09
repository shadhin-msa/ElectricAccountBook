<?php

use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                
    	Payment::insert([
			[
				'id' => '1',
				'amount'  => '100',
				'remark' => "Sample payment from seeder",
				'reason' => "system reason payment sample", 
				'customer_id' => 1, 
				'user_id' => 1,
 				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
 				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],[
				'id' => '2',
				'amount'  => '500',
				'remark' => "Second Sample payment from seeder",
				'reason' => "system reason payment sample", 
				'customer_id' => 1, 
				'user_id' => 1,
 				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
 				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
		]);
    }
}
