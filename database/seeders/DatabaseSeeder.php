<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Productor;
use App\Models\Finca;
use App\Models\Vivero;
use App\Models\Labor;
use App\Models\ProductosControl;
use App\Models\LaborProducto;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Productor::factory(15)->create();
        Finca::factory(20)->create();
        Vivero::factory(100)->create();
        Labor::factory(150)->create();
        ProductosControl::factory(40)->create();
        LaborProducto::factory(180)->create();

    }
}
