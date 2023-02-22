<?php

namespace Database\Seeders;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MaquinasCrear extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('maquinas')->insert([
           'modelo' => Str::random(10),
           'type' => Str::random(10),
           'components' => Str::random(10),
           'fabricante' => Str::random(10),
           'id_instalation' => mt_rand(1, 10),
           ]);
        }
    }
}
