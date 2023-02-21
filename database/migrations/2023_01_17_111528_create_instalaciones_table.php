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
        Schema::create('instalaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number_machine');
            $table->integer('id_user')->unsigned();
            $table->string("facility_name", 10);
            $table->string('street_name', 50);
            $table->integer('contractNumber');
            $table->integer('tokens')->default(0);
            $table->foreign('id_user')->references('id')->on('usuarios')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instalaciones');
    }
};
