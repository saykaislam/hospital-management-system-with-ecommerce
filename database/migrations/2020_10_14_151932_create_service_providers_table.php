<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_providers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('service_provider_category_id')->unsigned();
            $table->bigInteger('service_category_id')->unsigned();
            //$table->string('title')->nullable();
            //$table->string('slug')->unique();
            //$table->string('gender')->nullable();
            $table->string('cv')->nullable();
            $table->integer('is_active')->nullable();
            $table->string('personal_statement')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->longText('language')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('service_provider_category_id')->references('id')->on('service_provider_categories')->onDelete('cascade');
            $table->foreign('service_category_id')->references('id')->on('service_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_providers');
    }
}
