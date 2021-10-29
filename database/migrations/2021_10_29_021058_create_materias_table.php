<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMateriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombreMateria');
            $table->string('codigoMateria');

            $table->unsignedInteger('carreras_id');
            $table->foreign('carreras_id')->references('id')->on('carreras')->onUpdate('cascade')->onDelete('cascade');
            
            $table->unsignedInteger('pensums_id');
            $table->foreign('pensums_id')->references('id')->on('pensums')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materias');
    }
}
