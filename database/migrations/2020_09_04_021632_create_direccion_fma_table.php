<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDireccionFmaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direccion_fma', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('direccion');

            $table->unsignedBigInteger('ficha_medica_a_id');
            $table->foreign('ficha_medica_a_id')->references('id')->on('ficha_medica_a');

            $table->unsignedBigInteger('municipio_id');
            $table->foreign('municipio_id')->references('id')->on('municipio');

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
        Schema::dropIfExists('direccion_fma');
    }
}
