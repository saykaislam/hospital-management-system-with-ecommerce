<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceProviderEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_provider_educations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('service_provider_id')->unsigned();
            $table->string('degree');
            $table->string('institute');
            $table->string('year_of_completion');
            $table->timestamps();
            $table->foreign('service_provider_id')->references('id')->on('service_providers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_provider_educations');
    }
}
