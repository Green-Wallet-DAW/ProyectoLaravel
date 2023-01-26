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
        Schema::create('comunidades_servicios', function (Blueprint $table) {
            $table->integer('id_comunity')->unsigned();
            $table->integer('id_service')->unsigned();
            $table->primary(array('id_comunity','id_service'));
            $table->foreign('id_comunity')->references('id')->on('comunidades')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_service')->references('id')->on('servicios')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('comunidades_servicios');
    }
};
