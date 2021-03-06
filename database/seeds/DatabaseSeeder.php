<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('replace_products')->delete();
        DB::table('replaces')->delete();
        DB::table('invoice_products')->delete();
        DB::table('invoices')->delete();
        DB::table('payments')->delete();
        DB::table('stocks')->delete();
        DB::table('area_managers')->delete();
        DB::table('customers')->delete();
        DB::table('areas')->delete();
        DB::table('products')->delete();
        DB::table('delars')->delete();
        DB::table('categories')->delete();
        DB::table('users')->delete();


        // $this->call(UsersTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(DelarsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(AreasTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(AreaManagersTableSeeder::class);
        $this->call(StocksTableSeeder::class);
        $this->call(PaymentsTableSeeder::class);
        $this->call(InvoicesTableSeeder::class);
    }
}
