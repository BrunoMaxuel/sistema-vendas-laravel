<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory
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
            'nome' => $this->faker->word,
            'codigo_barras' => $this->faker->ean13,
            'preco' => $this->faker->randomFloat(2, 10, 100),
            'preco_custo' => $this->faker->randomFloat(2, 5, 50),
            'lucro' => $this->faker->randomFloat(2, 5, 50),
            'estoque' => $this->faker->numberBetween(1, 100),
            'fornecedor' => $this->faker->company,
            'categoria' => $this->faker->word,
        ];
    }
}
