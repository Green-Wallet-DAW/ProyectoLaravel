<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ServiciosCrear extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('servicios')->insert([
           'name' => Str::random(10),
           'description' => Str::random(10),
           'link' => Str::random(20),
           'precio' => mt_rand(1, 50),
           
           ]);
        }
    }
}