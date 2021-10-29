<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigoSolicitud');
            $table->date('fechaEnvio');
            $table->string('tipoEvaluacion');
            $table->string('ciclo');
            $table->string('anio');

            $table->unsignedInteger('usuarios_id');
            $table->foreign('usuarios_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedInteger('locales_id');
            $table->foreign('locales_id')->references('id')->on('locales')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitudes');
    }
}
