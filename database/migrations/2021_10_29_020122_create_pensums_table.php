<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePensumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pensums', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigoPensum');
            $table->string('nombrePensum');
            $table->string('anioCreacion');

            $table->unsignedInteger('carreras_id');
            $table->foreign('carreras_id')->references('id')->on('carreras')->onUpdate('cascade')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pensums');
    }
}
