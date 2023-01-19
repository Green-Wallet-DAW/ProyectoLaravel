<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class InstalacionesCrear extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('instalaciones')->insert([
           'number_machine' => mt_rand(1, 99999999),
           'id_user' => mt_rand(1, 10),
           //'master' => mt_rand(1, 100)
           ]);
        }
    }
}
