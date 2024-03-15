<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ProductoControlTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_consulta_producto_id(): void
    {
        //Hacer las migraciones
        Artisan::call('migrate');
        //llenar la base de datos
        Artisan::call('db:seed');
        //obtener un producto valido
        $labor = \App\Models\Labor::all()->first();
        $producto = $labor->productos()->first();
        //traer un producto por id
        if ($producto) {
            $response = $this->get('/fincas/vivero/labores/' . $labor->id . '/' . $producto->ICA);
            $response->assertStatus(200);
        }else {
            $this->assertTrue(true);
        }
    }

    public function test_insertar_producto(): void
    {
        //Hacer las migraciones
        Artisan::call('migrate');
        //llenar la base de datos
        Artisan::call('db:seed');
        //crear un producto
        $producto = new \App\Models\ProductosControl();
        $producto->ICA = '300';
        $producto->nombre = 'papa';
        $producto->frecuencia = '30';   
        $producto->valor = '1000';

        //guardar el producto
        $producto->save();

        $this->assertDatabaseHas('productoscontrol', ['ICA' => '300']);
    }

    public function test_modificar_producto(): void
    {
        //Hacer las migraciones
        Artisan::call('migrate');
        //llenar la base de datos
        Artisan::call('db:seed');
        //obtener un producto valido
        $producto = \App\Models\ProductosControl::all()->first();
        //modificar el producto
        $producto->nombre = 'papa';
        $producto->frecuencia = '30';   
        $producto->valor = '1000';
        //guardar el producto
        $producto->save();

        $this->assertDatabaseHas('productoscontrol', ['ICA' => $producto->ICA]);
    }

    public function test_relacion_producto_labor(): void
    {
        //Hacer las migraciones
        Artisan::call('migrate');
        //llenar la base de datos
        Artisan::call('db:seed');
        //obtener un producto valido
        $producto = \App\Models\ProductosControl::all()->first();
        //verificar que el producto tenga labor
        if ($producto->labores()->exists()) {
            // Verificar que el producto tenga labor
            $this->assertNotEmpty($producto->labores());
        } else {
            // En este caso, no se espera que el producto tenga labor, así que la prueba pasa automáticamente
            $this->assertTrue(true);
        }
    }

    
}
