<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('role_id')->unsigned();
            $table->string('name');
            $table->string('username')->nullable();
            $table->float('balance')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('country_code',191)->nullable()->default(+880);
            $table->string('phone')->unique();
            $table->string('gender')->nullable();
            $table->string('is_donor')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('image')->default('default.jpg');
            $table->integer('sign_up_type')->default(1);
            $table->integer('status')->nullable();
            $table->integer('approval_status')->nullable();
            $table->integer('active_inactive_status')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
