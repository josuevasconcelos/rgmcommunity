<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('templates')){
            Schema::create('templates', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->integer('numberOfBlocks');
                $table->integer('numberOfColumns');
                $table->integer('numberOfLines');
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
        Schema::dropIfExists('templates');
    }
}
