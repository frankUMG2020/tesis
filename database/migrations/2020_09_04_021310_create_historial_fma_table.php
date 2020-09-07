<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialFmaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_fma', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo')->unique();
            $table->smallInteger('correlativo');
            $table->smallInteger('edad');
            $table->decimal('peso',5,2);
            $table->decimal('talla',5,2);
            $table->decimal('pulso',5,2);
            $table->decimal('temperatura',5,2);
            $table->string('p_a');
            $table->decimal('respiracion',5,2);
            $table->decimal('so_dos',5,2);

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
        Schema::dropIfExists('historial_fma');
    }
}
