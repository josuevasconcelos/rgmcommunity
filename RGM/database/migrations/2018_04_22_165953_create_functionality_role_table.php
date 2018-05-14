<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctionalityRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('functionality_role')){
            Schema::create('functionality_role', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('functionality_id')->unsigned();
                $table->integer('role_id')->unsigned();
                $table->foreign('functionality_id')->references('id')->on('functionalities');
                $table->foreign('role_id')->references('id')->on('roles');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('functionality_role');
    }
}
