<?php

use App\Models\Area;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	Area::insert([
    		[
    			'id' => '1',
    			'name'  => 'Jurain',
    			'description' => 'Jurain er Just another description for this Area',
 				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
 				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    		],[
    			'id' => '2',
    			'name'  => 'Postogla',
    			'description' => 'Postogla Just another description for this Area',
 				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
 				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    		],[
    			'id' => '3',
    			'name'  => 'Demra',
    			'description' => 'Demra Just another description for this Area',
 				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
 				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    		]
    	]);
    }
 }
