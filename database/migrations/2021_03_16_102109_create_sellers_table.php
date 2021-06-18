<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            //$table->bigInteger('user_id')->unsigned();
            $table->integer('verification_status')->default(0);
            $table->longText('verification_info')->nullable();
            $table->integer('cash_on_delivery_status')->nullable();
            $table->double('admin_to_pay')->nullable();
            $table->double('seller_will_pay_admin')->nullable();
            $table->string('commission')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_acc_name')->nullable();
            $table->string('bank_acc_no')->nullable();
            $table->integer('bank_routing_no')->nullable();
            $table->integer('bank_payment_status')->nullable();
            $table->string('nid_number')->nullable();
            $table->string('trade_licence_images')->nullable();
            $table->timestamps();
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sellers');
    }
}
