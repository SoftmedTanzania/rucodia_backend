<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid');
            $table->integer('quantity');
            $table->integer('batch');
            $table->integer('statuses')->unsigned();
            $table->foreign('statuses')->references('id')->on('statuses');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
            $table->integer('dealer_id')->unsigned();
            $table->foreign('dealer_id')->references('id')->on('users');
            $table->integer('supplier_id')->nullable();
            $table->integer('created_by')->nullable($value = true)->default(0);;
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
