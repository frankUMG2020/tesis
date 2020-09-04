<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDireccionFmnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direccion_fmn', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('direccion');

            $table->unsignedBigInteger('ficha_medica_n_id');
            $table->foreign('ficha_medica_n_id')->references('id')->on('ficha_medica_n');

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
        Schema::dropIfExists('direccion_fmn');
    }
}
