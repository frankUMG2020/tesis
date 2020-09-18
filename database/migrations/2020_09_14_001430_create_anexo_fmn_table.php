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
            $table->longText('path');

            $table->unsignedBigInteger('historial_fmn_id');
            $table->foreign('historial_fmn_id')->references('id')->on('historial_fmn');
            
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
