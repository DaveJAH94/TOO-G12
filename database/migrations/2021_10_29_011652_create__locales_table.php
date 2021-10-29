<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigoLocal');
            $table->boolean('estadoReservado');

            $table->unsignedInteger('detalles_id');
            $table->foreign('detalles_id')->references('id')->on('localdetalles')->onUpdate('cascade')->onDelete('cascade');
            
            $table->unsignedInteger('edificios_id');
            $table->foreign('edificios_id')->references('id')->on('edificios')->onUpdate('cascade')->onDelete('cascade');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_locales');
    }
}
