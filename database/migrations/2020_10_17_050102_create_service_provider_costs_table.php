<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceProviderCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_provider_costs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('service_provider_id')->unsigned();
            $table->integer('monthly_cost')->nullable();
            $table->integer('fullday_cost')->nullable();
            $table->integer('halfday_cost')->nullable();
            $table->integer('home_cost')->nullable();
            $table->foreign('service_provider_id')->references('id')->on('service_providers')->onDelete('cascade');
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
        Schema::dropIfExists('service_provider_costs');
    }
}
