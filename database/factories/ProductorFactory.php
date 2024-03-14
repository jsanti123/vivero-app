<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Productor;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Productor>
 */
class ProductorFactory extends Factory
{
    protected $model = Productor::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'documento' => $this->faker->unique()->randomNumber(8),
            'nombre' => $this->faker->firstName,
            'apellidos' => $this->faker->lastName,
            'telefono' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
