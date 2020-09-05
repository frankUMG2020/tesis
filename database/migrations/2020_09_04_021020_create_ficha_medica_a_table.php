<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFichaMedicaATable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ficha_medica_a', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha');
            $table->string('estado_civil');
            $table->string('profesion')->nullable();
            $table->longText('foto')->nullable();
            $table->string('remitido')->nullable();
            $table->string('observacion', 500)->nullable();
            $table->string('codigo_epps')->nullable();
            $table->string('cui')->nullable();

            $table->unsignedBigInteger('tipo_sangre_id');
            $table->foreign('tipo_sangre_id')->references('id')->on('tipo_sangre');

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
        Schema::dropIfExists('ficha_medica_a');
    }
}
