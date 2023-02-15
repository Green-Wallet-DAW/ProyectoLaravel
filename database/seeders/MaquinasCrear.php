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
        for ($i = 0; $i < 3000; $i++) {
            DB::table('maquinas')->insert([
           'modelo' => Str::random(10),
           'energy_produced' => mt_rand(1, 10),
           'carbono_ahorrado' => mt_rand(1, 10),
           'type' => Str::random(10),
           'components' => Str::random(10),
           'fabricante' => Str::random(10),
           'date' => date('Y-m-d', strtotime( '+'.mt_rand(0,30).' days')),
        //    'instalation_id' =>mt_rand(1,10),
        //    'hours' =>  date('H:i:s', strtotime( '+'.mt_rand(0,24).' hours')),
           'tokens' => mt_rand(1,200),
           'id_instalation' => mt_rand(1, 10),
           'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
           ]);
        }
    }
}
