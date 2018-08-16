<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReplacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replaces', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->decimal('subtotal');
            $table->decimal('commission');
            $table->decimal('total_commission');
            $table->decimal('total_bill');
            $table->decimal('previous_due');
            $table->decimal('grand_total');
            $table->decimal('cash');
            $table->decimal('current_due');
            $table->integer('user_id')->unsigned();
            $table->integer('payment_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->timestamps();
        });


        Schema::create('replace_products', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('price');
            $table->integer('quantity');
            $table->decimal('total');
            $table->integer('product_id')->unsigned();
            $table->integer('replace_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('replace_id')->references('id')->on('replaces');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replace_products');
        Schema::dropIfExists('replaces');
    }
}
