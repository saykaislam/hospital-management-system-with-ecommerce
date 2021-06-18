<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicOpenClosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic_open_closes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('clinic_id');
            $table->text('day');
            $table->enum('open_close_status',['Open','Close']);
            $table->text('open_time')->nullable();
            $table->text('close_time')->nullable();
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
        Schema::dropIfExists('clinic_open_closes');
    }
}
