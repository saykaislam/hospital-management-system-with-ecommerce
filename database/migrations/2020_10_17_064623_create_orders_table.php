<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('service_provider_id')->nullable()->unsigned();
            $table->enum('order_type', ['service','product','clinic_schedule'])->nullable();
            $table->string('shipping_address')->nullable();
            $table->bigInteger('shop_id')->nullable();
            $table->string('area')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('service_provider_permission')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('payment_details')->nullable();
            $table->string('invoice_code')->nullable();
            $table->float('coupon_discount', 8,2)->nullable();;
            $table->float('discount', 8,2)->nullable();;
            $table->float('delivery_cost', 8,2)->nullable();;
            $table->string('delivery_status')->nullable();
            //$table->float('grand_total', 8,2)->nullable();;
            $table->string('grand_total');
            $table->double('total_vat')->default(0);
            $table->double('total_labour_cost')->default(0);
            $table->string('profit')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('ssl_status')->nullable();
            $table->string('currency')->nullable();
            $table->string('amount_after_getaway_fee')->nullable();
            $table->string('view')->nullable();
            $table->foreign('service_provider_id')->references('id')->on('service_providers')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
}
