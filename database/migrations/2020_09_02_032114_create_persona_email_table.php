<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonaEmailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona_email', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->unique();

            $table->unsignedBigInteger('persona_id');
            $table->foreign('persona_id')->references('id')->on('persona');

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
        Schema::dropIfExists('persona_email');
    }
}
