<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_reviews', function (Blueprint $table) {
//            $table->bigIncrements('id');
//            $table->bigInteger('user_id')->unsigned();
//            $table->bigInteger('product_id')->unsigned();
//            $table->integer('star')->nullable();
//            $table->string('experience')->nullable();
//            $table->string('extra')->nullable();
//            $table->timestamps();
//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
//            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->id();

            $table->bigInteger('user_id');
            $table->bigInteger('order_id');
            $table->bigInteger('shop_id');
            $table->bigInteger('product_id');
            $table->integer('rating')->default(0);
            $table->longText('comment')->nullable();
            $table->integer('status')->default(1);
            $table->integer('viewed')->default(0);
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
        Schema::dropIfExists('product_reviews');
    }
}
