<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Bruno Maxuel',
            'email' => 'brunomaxuel2@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('bruno123'), // Use Hash para criar a senha criptografada
            'remember_token' => null, // Pode ser null ou um token gerado com Str::random(10)
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Visitante',
            'email' => 'visitante@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('visitante123'), // Use Hash para criar a senha criptografada
            'remember_token' => null, // Pode ser null ou um token gerado com Str::random(10)
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}