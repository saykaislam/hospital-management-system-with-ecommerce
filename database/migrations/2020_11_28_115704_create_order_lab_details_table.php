<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderLabDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_lab_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('test_id')->unsigned();
            $table->string('test_name')->nullable();
            $table->float('test_price', 8,2)->nullable();
            $table->integer('test_quantity')->nullable();
            $table->float('test_sub_total', 8,2)->nullable();
            $table->integer('lab_id')->nullable();
            $table->string('delivery_type')->nullable();
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
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
        Schema::dropIfExists('order_lab_details');
    }
}
