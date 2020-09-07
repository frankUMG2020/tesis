<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateETFmnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_t_fmn', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('evolucion');
            $table->longText('tratamiento');

            $table->unsignedBigInteger('parametros_fmn_id');
            $table->foreign('parametros_fmn_id')->references('id')->on('parametros_fmn');
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
        Schema::dropIfExists('e_t_fmn');
    }
}
