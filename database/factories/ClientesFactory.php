<?php

namespace Database\Factories;

use App\Models\Clientes;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name,
            'CPF' => $this->faker->unique()->numerify('###########'),
            'sexo' => $this->faker->randomElement(['M', 'F', 'I']),
            'nascimento' => $this->faker->date(),
            'telefone' => $this->faker->phoneNumber,
            'endereco' => $this->faker->streetAddress,
            'numero' => $this->faker->buildingNumber,
            'cidade' => $this->faker->city,
        ];
    }
}

