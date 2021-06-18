<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('doctor_speciality_id')->unsigned();
            $table->string('search_title')->nullable();
            $table->string('question')->nullable();
            $table->string('question_quality')->nullable();
            $table->bigInteger('question_user_id')->unsigned();
            $table->integer('question_liked')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
            $table->foreign('doctor_speciality_id')->references('id')->on('doctor_specialities')->onDelete('cascade');
            $table->foreign('question_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
