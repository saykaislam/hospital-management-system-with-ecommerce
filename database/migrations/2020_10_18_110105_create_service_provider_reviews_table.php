<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceProviderReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_provider_reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('service_provider_id')->unsigned();
            $table->integer('star')->nullable();
            $table->string('problem')->nullable();
            $table->longText('description')->nullable();
            $table->integer('status')->default(1);
            $table->integer('viewed')->default(0);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('service_provider_id')->references('id')->on('service_providers')->onDelete('cascade');
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
        Schema::dropIfExists('service_provider_reviews');
    }
}
