<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateETFmaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

     //Crear modelo y controlador en la carpeta que se llama sistema
    public function up()
    {
        Schema::create('e_t_fma', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('evolucion');
            $table->longText('tratamiento');

            $table->unsignedBigInteger('parametros_fma_id');
            $table->foreign('parametros_fma_id')->references('id')->on('parametros_fma');
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
        Schema::dropIfExists('e_t_fma');
    }
}
