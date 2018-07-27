<?php

use App\Models\AreaManager;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AreaManagersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	AreaManager::insert([
    		[
    			'id' => '1',
    			'name'  => 'Sample Manager 1',
    			'address' => 'Demo address of manager',
    			'phone' => '+88019834234',
    			'areaId' => 2,
    			'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    			'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    		],
    		[
    			'id' => '2',
    			'name'  => 'Another manager',
    			'address' => 'dholaipar',
    			'phone' => '+880167645345', 
    			'areaId' => 1,
    			'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    			'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    		]
    	]);
    }
 }
