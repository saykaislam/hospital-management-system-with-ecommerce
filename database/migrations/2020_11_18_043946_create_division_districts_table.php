<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDivisionDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('division_districts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('division_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('bn_name')->nullable();
            $table->string('lat')->nullable();
            $table->string('lon')->nullable();
            $table->string('url')->nullable();
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
        Schema::dropIfExists('division_districts');
    }
}
