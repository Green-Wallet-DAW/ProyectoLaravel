<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_maquinas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('energy_produced')->default(0);
            $table->integer('carbono_ahorrado')->default(0);
            $table->date('date');
            $table->integer('tokens')->default(0);
            $table->integer('id_maquina')->unsigned();
            $table->foreign('id_maquina')->references('id')->on('maquinas')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datos_maquinas');
    }
};
