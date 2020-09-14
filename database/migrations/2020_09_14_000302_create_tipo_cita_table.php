<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoCitaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    //Crear modelo y controlador en la carpeta que se llama catalogo
    public function up()
    {
        Schema::create('tipo_cita', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre')->unique();
            $table->string('color');
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
        Schema::dropIfExists('tipo_cita');
    }
}
