<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelatedQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('related_questions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('doctor_speciality_id')->unsigned();
            $table->string('search_title')->nullable();
            $table->string('question')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('related_questions');
    }
}
