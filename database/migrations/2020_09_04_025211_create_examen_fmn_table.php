<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamenFmnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examen_fmn', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('historial_fmn_id');
            $table->foreign('historial_fmn_id')->references('id')->on('historial_fmn');

            $table->unsignedBigInteger('examen_id');
            $table->foreign('examen_id')->references('id')->on('examen');
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
        Schema::dropIfExists('examen_fmn');
    }
}
