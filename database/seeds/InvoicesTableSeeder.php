<?php

use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class InvoicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	

    	Invoice::insert([
    		[
                'id' => '1',
                'customer_id' => '1',
    			'subtotal'  => '1000',
    			'commission' => 4,
    			'total_commission' => 40,
    			'total_bill' => 960,
    			'previous_due' => 0,
    			'grand_total' => 960,
    			'cash' => 100,
    			'current_due' => 860,
    			'user_id' => 1,
    			'payment_id' => 1,
    			'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    			'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    		]
    	]);
    }
 }
