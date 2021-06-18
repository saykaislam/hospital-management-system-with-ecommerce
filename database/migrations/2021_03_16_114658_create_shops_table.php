<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            //$table->bigInteger('user_id')->unsigned();
            $table->bigInteger('seller_id');
            //$table->bigInteger('seller_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->text('about')->nullable();
            $table->string('logo')->nullable();
            $table->longText('sliders')->nullable();
            $table->mediumText('address')->nullable();
            $table->string('area')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('sub_district')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('facebook')->nullable();
            $table->string('google')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('pick_up_point_id')->nullable();
            $table->double('shipping_cost')->nullable();
            $table->timestamps();
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //$table->foreign('seller_id')->references('id')->on('sellers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
