<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowUpEPrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follow_up_e_prescriptions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->bigInteger('doctor_user_id')->nullable()->unsigned();
            $table->bigInteger('e_prescription_id')->nullable()->unsigned();
            $table->integer('slot_id')->nullable();
            $table->string('invoice')->nullable();
            $table->string('date')->nullable();
            $table->string('signature')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('doctor_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('e_prescription_id')->references('id')->on('e_prescriptions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follow_up_e_prescriptions');
    }
}
