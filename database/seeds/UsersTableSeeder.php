<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    	User::insert([
			[
				'id' => '1',
				'name'  => 'Admin',
				'email' => 'admin@test.com',
				'password' => bcrypt('admin'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],[
                'id' => '2',
                'name'  => '2nd admin',
                'email' => 'admin2@test.com',
                'password' => bcrypt('admin'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],[
                'id' => '3',
                'name'  => '3rd admin',
                'email' => 'admin3@test.com',
                'password' => bcrypt('admin'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
		]);
    }
}
