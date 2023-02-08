<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsuariosCrear extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
for ($i = 0; $i < 10; $i++) {
    DB::table('usuarios')->insert([
   'name' => Str::random(10),
   'password' => password_hash(Str::random(10),PASSWORD_DEFAULT),
   'email' => Str::random(10).'@gmail.com',
   'phone_number' => mt_rand(100000000, 999999999)
   ]);
}
    }
}
