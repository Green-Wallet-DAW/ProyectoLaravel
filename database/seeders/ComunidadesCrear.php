<?php

namespace Database\Seeders;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ComunidadesCrear extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('comunidades')->insert([
           'name' => Str::random(10),
           'description' => Str::random(100),
<<<<<<< HEAD
           'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
           //'master' => mt_rand(1, 100)
=======
           'master' => mt_rand(1, 10),
>>>>>>> refs/remotes/origin/master
           ]);
        }
    }
}
