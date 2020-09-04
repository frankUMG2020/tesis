<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInmuncionHistorialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inmuncion_historial', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('restante');

            $table->unsignedBigInteger('historial_fmn_id');
            $table->foreign('historial_fmn_id')->references('id')->on('historial_fmn');

            $table->unsignedBigInteger('vacuna_id');
            $table->foreign('vacuna_id')->references('id')->on('vacuna');

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
        Schema::dropIfExists('inmuncion_historial');
    }
}
