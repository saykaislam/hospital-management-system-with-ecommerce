<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('service_category_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('slug')->unique();
            $table->string('route')->nullable();
            $table->string('image')->default('default.jpg');
            $table->foreign('service_category_id')->references('id')->on('service_categories')->onDelete('cascade');
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
        Schema::dropIfExists('service_sub_categories');
    }
}
