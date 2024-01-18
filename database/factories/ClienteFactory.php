<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'user_id' => $this->faker->randomElement([1, 2]),
            'nome' => $this->faker->name,
            'endereco' => $this->faker->streetAddress,
            'telefone' => $this->faker->phoneNumber,
            'bairro' => $this->faker->secondaryAddress,
            'cidade' => $this->faker->city,
        ];
    }
}

