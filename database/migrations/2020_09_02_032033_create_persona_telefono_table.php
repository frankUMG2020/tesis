<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonaTelefonoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona_telefono', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('numero')->unique();

            $table->unsignedBigInteger('tipo_telefono_id');
            $table->foreign('tipo_telefono_id')->references('id')->on('tipo_telefono');

            $table->unsignedBigInteger('compania_id');
            $table->foreign('compania_id')->references('id')->on('compania');

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
        Schema::dropIfExists('persona_telefono');
    }
}
