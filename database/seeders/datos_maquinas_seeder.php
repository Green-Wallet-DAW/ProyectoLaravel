<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class datos_maquinas_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 3000; $i++) {
            DB::table('datos_maquinas')->insert([
           'energy_produced' => mt_rand(1, 10),
           'carbono_ahorrado' => mt_rand(1, 10),
           'date' => date('Y-m-d', strtotime( '+'.mt_rand(0,30).' days')),
           'tokens' => mt_rand(1,200),
           'id_maquina' => mt_rand(1, 10),
           ]);
        }
    }
}
