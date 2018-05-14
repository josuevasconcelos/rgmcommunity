<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('projects')){
            Schema::create('projects', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->integer('difficultylevel_id')->unsigned();
                $table->integer('type_id')->unsigned();
                $table->integer('template_id')->unsigned();
                $table->integer('audio_id')->unsigned();
                $table->integer('user_id')->unsigned();
                $table->foreign('difficultylevel_id')->references('id')->on('difficultylevels');
                $table->foreign('type_id')->references('id')->on('types');
                $table->foreign('template_id')->references('id')->on('templates');
                $table->foreign('audio_id')->references('id')->on('audios');
                $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('projects');
    }
}
