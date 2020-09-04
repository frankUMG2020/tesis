<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnfermedadHistorialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enfermedad_historial', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('cantidad')->default(0);

            $table->unsignedBigInteger('historial_fmn_id');
            $table->foreign('historial_fmn_id')->references('id')->on('historial_fmn');

            $table->unsignedBigInteger('configuracion_enfermedad_id');
            $table->foreign('configuracion_enfermedad_id')->references('id')->on('configuracion_enfermedad');

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
        Schema::dropIfExists('enfermedad_historial');
    }
}
