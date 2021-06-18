<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_tests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('clinic_or_lab_user_id')->unsigned();
            $table->bigInteger('test_id')->unsigned();
            $table->integer('lab_test_regular_price')->nullable();
            $table->integer('lab_test_price')->nullable();
            $table->timestamps();
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_tests');
    }
}
