<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Finca;
use App\Models\Productor;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Finca>
 */
class FincaFactory extends Factory
{
    protected $model = Finca::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productoresIds = Productor::pluck('documento')->toArray();
        
        return [
            'num_catastro' => $this->faker->unique()->randomNumber(8),
            'municipio' => $this->faker->city,
            'productores_id' => $this->faker->randomElement($productoresIds),
        ];
    }
}
