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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',20);
            $table->string('password',255);
            $table->string('email',100);
            $table->integer('token')->default(0);
            $table->enum('rol',['user','admin'])->default('user');
            $table->integer('cumn')->nullable();
            $table->integer('phone_number');
            $table->enum('newsletter',['SI','NO'])->default('NO');
            $table->integer('number_comunity')->default(0);
            $table->unique(array('email','phone_number'));
            $table->timestamps(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
};
