<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnexoFmnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    //Crear modelo y controlador en la carpeta que se llama sistema
    public function up()
    {
        Schema::create('anexo_fmn', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('path');

            $table->unsignedBigInteger('ficha_medica_n_id');
            $table->foreign('ficha_medica_n_id')->references('id')->on('ficha_medica_n');
            
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
        Schema::dropIfExists('anexo_fmn');
    }
}
