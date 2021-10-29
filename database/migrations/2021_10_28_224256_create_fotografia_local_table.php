<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFotografiaLocalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('local_fotografias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url');

            $table->unsignedInteger('localdetalles_id');
            $table->foreign('localdetalles_id')->references('id')->on('localdetalles')->onUpdate('cascade')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('local_fotografias');
    }
}
