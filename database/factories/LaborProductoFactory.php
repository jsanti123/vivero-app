<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\LaborProducto;
use App\Models\Labor;
use App\Models\ProductosControl;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LaborProducto>
 */
class LaborProductoFactory extends Factory
{
    protected $model = LaborProducto::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $laboresIds = Labor::pluck('id')->toArray();
        $productosIds = ProductosControl::pluck('ICA')->toArray();
        return [
            'labor_id' => $this->faker->randomElement($laboresIds),
            'producto_id' => $this->faker->randomElement($productosIds),
            'periodo_carencia' => $this->faker->randomElement(['10', '15', '30', '60', NULL]),
            'fecha_ultima_aplicacion' => $this->faker->optional()->dateTimeThisYear(),
            'hongo' => $this->faker->randomElement(['Pleurotus', 'Agaricus', 'Lentinula', 'Volvariella', 'Laetiporus', NULL]),
        ];
    }
}
