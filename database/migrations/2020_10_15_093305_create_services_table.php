<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('service_provider_category_id')->unsigned()->nullable();
            $table->bigInteger('service_category_id')->unsigned();
            $table->bigInteger('service_sub_category_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->integer('price')->nullable();
            $table->string('image')->default('default.jpg');
            $table->string('icon')->default('default.png');
            $table->string('service_type')->nullable();
            $table->bigInteger('division_district_id')->nullable()->unsigned();
            $table->foreign('service_provider_category_id')->references('id')->on('service_provider_categories')->onDelete('cascade');
            $table->foreign('service_category_id')->references('id')->on('service_categories')->onDelete('cascade');
            $table->foreign('service_sub_category_id')->references('id')->on('service_sub_categories')->onDelete('cascade');
            $table->foreign('division_district_id')->references('id')->on('division_districts')->onDelete('cascade');
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
        Schema::dropIfExists('services');
    }
}
