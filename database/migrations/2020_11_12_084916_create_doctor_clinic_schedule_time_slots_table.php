<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorClinicScheduleTimeSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_clinic_schedule_time_slots', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('d_c_schedule_id')->unsigned();
            $table->bigInteger('doctor_user_id')->unsigned();
            $table->bigInteger('clinic_user_id')->unsigned();
            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->string('time')->nullable();
            $table->string('date')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->foreign('d_c_schedule_id')->references('id')->on('doctor_clinic_schedules')->onDelete('cascade');
            $table->foreign('doctor_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('clinic_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_clinic_schedule_time_slots');
    }
}
