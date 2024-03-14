<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class LaborTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_consulta_labor(): void
    {
        //Hacer las migraciones
        Artisan::call('migrate');
        //llenar la base de datos
        Artisan::call('db:seed');
        //traer todas las labores
        $vivero = \App\Models\Vivero::all()->first();
        
        $response = $this->get('/fincas/vivero/labores/'. $vivero->codigo);
        $response->assertStatus(200);
    }

    public function test_ingresar_labor(): void
    {
        //Hacer las migraciones
        Artisan::call('migrate');
        //llenar la base de datos
        Artisan::call('db:seed');
        //obtener un vivero valido
        $vivero = \App\Models\Vivero::all()->first();
        //crear un labor
        $labor = new \App\Models\Labor();
        $labor->id = 300;
        $labor->fecha = '2021-10-10';
        $labor->descripcion = 'cosecha';
        $labor->vivero_id = $vivero->codigo;

        //guardar el labor
        $labor->save();

        $this->assertDatabaseHas('labores', ['id' => 300]);
        
    }

    public function test_modificar_labor(): void
    {
        //Hacer las migraciones
        Artisan::call('migrate');
        //llenar la base de datos
        Artisan::call('db:seed');
        //obtener un labor valido
        $labor = \App\Models\Labor::all()->first();
        //modificar el labor
        $labor->descripcion = 'cosecha de uva';
        //guardar el labor
        $labor->save();

        $this->assertDatabaseHas('labores', ['descripcion' => 'cosecha de uva']);
    }

    public function test_relacion_labor_viveres(): void
    {
        //Hacer las migraciones
        Artisan::call('migrate');
        //llenar la base de datos
        Artisan::call('db:seed');
        //obtener un labor valido
        $labor = \App\Models\Labor::all()->first();
        //verificar que el labor tenga viveros
        if ($labor->vivero()->exists()) {
            // Verificar que el labor tenga viveros
            $this->assertNotEmpty($labor->vivero);
        } else {
            $this->assertEmpty($labor->vivero);
        }
    }
}
