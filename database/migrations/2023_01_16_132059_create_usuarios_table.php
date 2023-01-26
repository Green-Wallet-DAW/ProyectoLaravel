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
            $table->string('name',40);
            $table->string('password',255);
            $table->string('email',100);
            $table->float('token', 8, 2)->default(0);
            $table->enum('rol',['user','admin'])->default('user');
            $table->string('cumn', 50)->nullable();
            $table->integer('phone_number');
            $table->boolean('newsletter')->default(false);
            $table->integer('number_comunity')->default(0);
            $table->unique(array('email','phone_number'));
            $table->timestamps();
<<<<<<< HEAD
=======

>>>>>>> refs/remotes/origin/master
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
