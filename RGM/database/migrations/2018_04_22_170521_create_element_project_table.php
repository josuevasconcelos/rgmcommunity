<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElementProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('element_project')){
            Schema::create('element_project', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('element_id')->unsigned();
                $table->integer('project_id')->unsigned();
                $table->string('block');
                $table->string('line');
                $table->string('column');
                $table->foreign('element_id')->references('id')->on('elements');
                $table->foreign('project_id')->references('id')->on('projects');
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
        Schema::dropIfExists('element_project');
    }
}
