<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('localdetalles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombreLocal');
            $table->integer('capacidad');
            $table->string('descripcion');
            $table->string('planta');
            $table->float('altitud');
            $table->float('latitud');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('local_detalles');
    }
}
