<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Labor;
use App\Models\Vivero;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Labor>
 */
class LaborFactory extends Factory
{

    protected $model = Labor::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $viverosIds = Vivero::pluck('codigo')->toArray();

        return [
            'id' => $this->faker->unique()->randomNumber(8),
            'fecha' => $this->faker->dateTimeThisYear(),
            'descripcion' => $this->faker->text(200),
            'vivero_id' => $this->faker->randomElement($viverosIds),
        ];
    }
}
