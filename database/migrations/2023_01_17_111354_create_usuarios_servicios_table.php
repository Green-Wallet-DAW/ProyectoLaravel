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
        Schema::create('usuarios_servicios', function (Blueprint $table) {
            $table->integer('id_service')->unsigned();
            $table->integer('id_user')->unsigned();
            $table->primary(array('id_service','id_user'));
            $table->foreign('id_service')->references('id')->on('servicios')

            ->onUpdate('cascade');
            $table->foreign('id_user')->references('id')->on('usuarios')

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
