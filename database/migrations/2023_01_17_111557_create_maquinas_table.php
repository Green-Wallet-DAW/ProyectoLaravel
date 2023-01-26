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
        Schema::create('maquinas', function (Blueprint $table) {
            $table->string('modelo',25);
            $table->integer('energy_produced')->default(0);
            $table->integer('carbono_ahorrado')->default(0);
            $table->string('type',25);
            $table->string('components',100);
            $table->string('fabricante',25);
            $table->integer('id_instalation')->unsigned();
            $table->primary('modelo');
            $table->foreign('id_instalation')->references('id')->on('instalaciones')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('maquinas');
    }
};
