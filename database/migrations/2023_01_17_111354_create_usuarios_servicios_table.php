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
        Schema::create('servicio_usuario', function (Blueprint $table) {
            $table->integer('servicio_id')->unsigned();
            $table->integer('usuario_id')->unsigned();
            $table->primary(array('servicio_id','usuario_id'));
            $table->foreign('servicio_id')->references('id')->on('servicios')
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
        Schema::dropIfExists('usuarios_servicios');
    }
};
