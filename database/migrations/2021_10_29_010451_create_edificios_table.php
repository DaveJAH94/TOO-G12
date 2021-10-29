<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdificiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edificios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('idEdificio');
            $table->string('codigoEdificio');
            $table->string('nombreEdificio');

            $table->unsignedInteger('facultades_id');
            $table->foreign('facultades_id')->references('id')->on('facultades')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('edificios');
    }
}
