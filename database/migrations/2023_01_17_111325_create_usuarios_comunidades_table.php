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
        Schema::create('comunidad_usuario', function (Blueprint $table) {
            $table->integer('comunidad_id')->unsigned();
            $table->integer('usuario_id')->unsigned();
            $table->primary(array('comunidad_id','usuario_id'));
            $table->foreign('comunidad_id')->references('id')->on('comunidades')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('usuario_id')->references('id')->on('usuarios')
            ->onDelete('cascade')
            ->onUpdate('cascade');
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
        Schema::dropIfExists('comunidad_usuario');
    }
};
