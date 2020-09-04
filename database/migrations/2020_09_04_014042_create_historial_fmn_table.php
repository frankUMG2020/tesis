<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialFmnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_fmn', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo')->unique();
            $table->smallInteger('correlativo');
            $table->smallInteger('edad');
            $table->decimal('peso',5,2);
            $table->longText('descripcion');

            $table->unsignedBigInteger('ficha_medica_n_id');
            $table->foreign('ficha_medica_n_id')->references('id')->on('ficha_medica_n');

            $table->softDeletes();
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
        Schema::dropIfExists('historial_fmn');
    }
}
