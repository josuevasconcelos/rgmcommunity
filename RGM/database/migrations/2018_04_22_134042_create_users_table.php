<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->integer('age')->nullable();
            $table->string('address')->nullable();
            $table->string('cellphoneNumber')->nullable();
            $table->string('country')->nullable();
            $table->string('communityRGM')->nullable();
            $table->string('avatar')->default('default.jpg');
            $table->string('otherInformation')->nullable();
            $table->string('status')->nullable();
            $table->string('typeOfPatient')->nullable();
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles');
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
