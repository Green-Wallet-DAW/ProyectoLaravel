<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class test_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 0; $i < 100; $i++) {
            DB::table('test_table')->insert([
            'energy_produced' => random_int(1,200),
            'carbono_ahorrado' => random_int(1,200),
            'hora' =>  date('Y-m-d', strtotime( '+'.mt_rand(0,30).' days')),
            'tokens' => random_int(1,200),
            'instalation_id' => random_int(1,10),

            ]);
        }
    }
}
