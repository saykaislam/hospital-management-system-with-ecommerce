<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('doctor_speciality_id')->unsigned();
            $table->string('title')->nullable();
            $table->string('slug')->unique();
            $table->string('gender')->nullable();
            $table->integer('is_active')->nullable();
            $table->integer('is_online')->nullable();
            $table->integer('has_permission')->nullable();
            $table->integer('has_clinic')->nullable();
            $table->integer('has_home_service')->nullable();
            $table->integer('is_on_demand')->nullable();
            $table->string('home_cost')->nullable();
            $table->string('Bmdc_number')->nullable();
            $table->string('personal_statement')->nullable();
            $table->longText('language')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('doctor_speciality_id')->references('id')->on('doctor_specialities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctors');
    }
}
