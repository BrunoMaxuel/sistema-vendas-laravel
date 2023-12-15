<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cliente' => $this->faker->name,
            'desconto' => $this->faker->numberBetween(0, 50),
            'parcelas' => $this->faker->numberBetween(1, 12),
            'valor_parcelas' => $this->faker->randomFloat(2, 10, 500),
            'total_venda' => $this->faker->randomNumber(4),
            'pagamento' => $this->faker->randomElement(['DI', 'CR', 'DE']),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
