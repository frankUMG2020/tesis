<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFichaMedicaNTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ficha_medica_n', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha');
            $table->string('padre')->nullable();
            $table->string('madre')->nullable();
            $table->string('referido')->nullable();
            $table->string('email')->nullable();
            $table->string('lugar_nacimiento')->nullable();
            $table->longText('foto')->nullable();

            $table->unsignedBigInteger('municipio_id');
            $table->foreign('municipio_id')->references('id')->on('municipio');

            $table->unsignedBigInteger('persona_id');
            $table->foreign('persona_id')->references('id')->on('persona');

            $table->unsignedBigInteger('parto_id');
            $table->foreign('parto_id')->references('id')->on('parto');

            $table->unsignedBigInteger('alimentacion_id');
            $table->foreign('alimentacion_id')->references('id')->on('alimentacion');

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
        Schema::dropIfExists('ficha_medica_n');
    }
}
