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
        Schema::create('chats', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('tipo',['general','soporte'])->default('general');
            $table->integer('sender')->unsigned();
            $table->integer('receiver')->unsigned();
            $table->longText('message');
            $table->timestamps();
            $table->foreign('sender')->references('id')->on('usuarios')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('receiver')->references('id')->on('usuarios')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chats');
    }
};
