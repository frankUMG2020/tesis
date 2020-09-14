<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarioFmaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    //Crear modelo y controlador en la carpeta que se llama sistema
    public function up()
    {
        Schema::create('calendario_fma', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cita');
            $table->date('fecha');
            $table->time('hora');

            $table->unsignedBigInteger('ficha_medica_a_id');
            $table->foreign('ficha_medica_a_id')->references('id')->on('ficha_medica_a');

            $table->unsignedBigInteger('estado_calendario_id');
            $table->foreign('estado_calendario_id')->references('id')->on('estado_calendario');

            $table->unsignedBigInteger('tipo_cita_id');
            $table->foreign('tipo_cita_id')->references('id')->on('tipo_cita');

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
        Schema::dropIfExists('calendario_fma');
    }
}
