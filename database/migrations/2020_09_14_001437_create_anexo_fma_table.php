<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnexoFmaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    //Crear modelo y controlador en la carpeta que se llama sistema
    public function up()
    {
        Schema::create('anexo_fma', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('path');

            $table->unsignedBigInteger('historial_fma_id');
            $table->foreign('historial_fma_id')->references('id')->on('historial_fma');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anexo_fma');
    }
}
