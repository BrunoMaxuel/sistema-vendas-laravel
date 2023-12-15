<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class VendasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome_produto' => $this->faker->word,
            'codigo_barras' => $this->faker->ean13,
            'quantidade' => $this->faker->numberBetween(1, 100),
            'valor_item' => $this->faker->randomFloat(2, 10, 500),
            'desconto' => $this->faker->randomNumber(50),
            'pagamento' => $this->faker->randomElement(['DI', 'CR', 'DE']),
            'parcelas' => $this->faker->randomNumber(12),
            'valor_parcelas' => $this->faker->randomFloat(2, 10, 500),
            'total_venda' => $this->faker->randomFloat(2, 50, 1000),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
