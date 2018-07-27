<?php

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::insert([
        [
            'id' => '1',
            'name'  => 'Customer 1',
            'address' => '135 eas jurain',
            'phone' => '+88019834234',
            'propiter' => 'n/a',
            'others' => 'notes for customer',
            'areaId' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],
        [
            'id' => '2',
            'name'  => 'Customer two',
            'address' => 'dholaipar',
            'phone' => '+880167645345', 
            'propiter' => 'n/a',
            'others' => 'notes for customer',
            'areaId' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]
    ]);
    }
}
