<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductosControl;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductosControlFactory extends Factory
{
    protected $model = ProductosControl::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ICA' => $this->faker->randomNumber(8),
            'nombre' => $this->faker->company,
            'frecuencia' => $this->faker->randomElement(['10', '15', '30', '60']),
            'valor' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
