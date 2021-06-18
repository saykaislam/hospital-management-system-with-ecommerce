<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorSpecialityDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_speciality_doctors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('doctor_id')->unsigned();
            $table->bigInteger('doctor_speciality_id')->unsigned();
            $table->integer('main_specialist_status')->nullable();
            $table->timestamps();
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
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
        Schema::dropIfExists('doctor_speciality_doctors');
    }
}
