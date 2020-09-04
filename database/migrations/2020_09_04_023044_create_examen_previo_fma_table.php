<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamenPrevioFmaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examen_previo_fma', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('descripcion');

            $table->unsignedBigInteger('general_fma_id');
            $table->foreign('general_fma_id')->references('id')->on('general_fma');
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
        Schema::dropIfExists('examen_previo_fma');
    }
}
