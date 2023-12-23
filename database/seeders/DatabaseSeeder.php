<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Produto;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    
    public function run(): void
    {

        $this->call([
            UserSeeder::class,
        ]);

        Cliente::factory(50)->create();
        Produto::factory(50)->create();
    }
}
