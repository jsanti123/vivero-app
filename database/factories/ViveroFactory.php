<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vivero;
use App\Models\Finca;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vivero>
 */
class ViveroFactory extends Factory
{
    protected $model = Vivero::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $CatastroAndMunicipio = Finca::pluck('municipio', 'num_catastro');
        $num_catastro = $CatastroAndMunicipio->keys()->random();
        $municipio = $CatastroAndMunicipio->get($num_catastro);

        return [
            'codigo' => $this->faker->unique()->randomNumber(8),
            'cultivo' => $this->faker->randomElement(['Pimiento', 'Tomate', 'Pepino', 'Calabacín', 'Berenjena']),
            'num_catastro' => $num_catastro,
            'municipio' => $municipio,
        ];
    }
}
