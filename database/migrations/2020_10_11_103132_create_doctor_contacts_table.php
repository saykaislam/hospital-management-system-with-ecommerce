<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_contacts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('doctor_id')->unsigned();
            $table->bigInteger('division_district_id')->nullable()->unsigned();
            $table->text('address')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('city')->nullable();
            $table->string('state_or_province')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();
            $table->timestamps();
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->foreign('division_district_id')->references('id')->on('division_districts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_contacts');
    }
}
