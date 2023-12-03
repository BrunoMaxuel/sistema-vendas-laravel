<?php

namespace Database\Seeders;

use App\Models\Clientes;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    
    public function run(): void
    {
        // $this->call(ClienteSeeder::class);
        Clientes::factory(50)->create();
    }
}
