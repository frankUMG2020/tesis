<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParametrosFmaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parametros_fma', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('parametro_uno')->nullable();
            $table->longText('parametro_dos')->nullable();
            $table->longText('parametro_tres')->nullable();
            $table->longText('parametro_cuatro')->nullable();
            $table->longText('parametro_seis')->nullable();
            $table->longText('parametro_siete')->nullable();
            $table->longText('parametro_ocho')->nullable();
            $table->longText('parametro_nueve')->nullable();
            $table->longText('parametro_diez')->nullable();
            $table->longText('parametro_once')->nullable();
            $table->longText('parametro_doce')->nullable();
            $table->longText('parametro_trece')->nullable();
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
        Schema::dropIfExists('parametros_fma');
    }
}
