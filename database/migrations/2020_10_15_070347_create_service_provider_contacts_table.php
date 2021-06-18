<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceProviderContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_provider_contacts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('service_provider_id')->unsigned();
            $table->bigInteger('division_district_id')->nullable()->unsigned();
            $table->text('address')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('city')->nullable();
            $table->string('state_or_province')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();
            $table->foreign('service_provider_id')->references('id')->on('service_providers')->onDelete('cascade');
            $table->foreign('division_district_id')->references('id')->on('division_districts')->onDelete('cascade');
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
        Schema::dropIfExists('service_provider_contacts');
    }
}
