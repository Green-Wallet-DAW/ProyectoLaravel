<?php

namespace Database\Seeders;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\available_machines;
use App\Models\TestTable;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            UsuariosCrear::class,
            ComunidadesCrear::class,
            ServiciosCrear::class,
            InstalacionesCrear::class,
            MaquinasCrear::class,
            // available_machinesSeeder::class,
        ]);
    }
}
