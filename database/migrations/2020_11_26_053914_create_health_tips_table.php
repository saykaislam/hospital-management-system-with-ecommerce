<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthTipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_tips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('health_tips_category_id')->unsigned();
            $table->bigInteger('doctor_id')->unsigned();
            $table->string('slug')->unique();
            $table->string('title')->nullable();
            $table->string('title_bangla')->nullable();
            $table->string('contents')->nullable();
            $table->string('content_bangla')->nullable();
            $table->string('image')->default('default.jpg');
            $table->string('image_alt')->nullable();
            $table->string('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->foreign('health_tips_category_id')->references('id')->on('health_tips_categories')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('health_tips');
    }
}
