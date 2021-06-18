<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorClinicSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_clinic_schedules', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('day_id')->unsigned();
            $table->bigInteger('doctor_user_id')->unsigned();
            $table->bigInteger('clinic_user_id')->unsigned();
            $table->string('date')->nullable();
            $table->string('start_time');
            $table->string('end_time');
            $table->string('interval_time');
            $table->string('is_active')->default(1);
            $table->timestamps();
            $table->foreign('day_id')->references('id')->on('days')->onDelete('cascade');
            $table->foreign('doctor_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('clinic_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_clinic_schedules');
    }
}
