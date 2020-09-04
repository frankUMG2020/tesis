<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelefonoFmaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telefono_fma', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('numero');

            $table->unsignedBigInteger('ficha_medica_a_id');
            $table->foreign('ficha_medica_a_id')->references('id')->on('ficha_medica_a');

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
        Schema::dropIfExists('telefono_fma');
    }
}
