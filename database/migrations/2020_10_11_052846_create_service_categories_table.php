<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('service_provider_category_id')->unsigned()->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->unique();
            $table->string('image')->default('default.jpg');
            $table->string('icon')->default('default.png');
            $table->string('route')->nullable();
            $table->timestamps();
            $table->foreign('service_provider_category_id')->references('id')->on('service_provider_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_categories');
    }
}
