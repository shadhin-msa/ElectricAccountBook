<?php

use App\Models\Delar;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DelarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    Delar::insert([
        [
            'id' => '1',
            'name'  => 'test delar 1',
            'address' => '135 eas jurain',
            'phone' => '+8801676770332', 
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],
        [
            'id' => '2',
            'name'  => 'delar test 2',
            'address' => '135 eas jurain',
            'phone' => '+8801676770332', 
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]
    ]);
 }
}
