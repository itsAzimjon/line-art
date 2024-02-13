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
                $table->id();
                $table->integer('role_id')->default(4);
                $table->string('name');
                $table->integer('age');
                $table->string('gender');
                $table->string('job');
                $table->string('experience')->default('0');
                $table->string('region');
                $table->text('photo')->nullable();
                $table->integer('verified')->nullable();
                $table->string('email')->nullable()->unique();
                $table->string('phone')->nullable()->unique();
                $table->string('verify_otp')->nullable();
                $table->string('password');
                $table->integer('credit')->default(0);
                $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
