<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ProductorTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_consulta_productor(): void
    {

        //Hacer las migraciones
        Artisan::call('migrate');
        //llenar la base de datos
        Artisan::call('db:seed');
        //traer todos los productores
        $response = $this->get('/productores');
        $response->assertStatus(200)->assertSee('productores');

    }

    public function test_consulta_productor_id(): void
    {
        //Hacer las migraciones
        Artisan::call('migrate');
        //llenar la base de datos
        Artisan::call('db:seed');
        //obtener un productor valido
        $productor = \App\Models\Productor::all()->first();
        //traer un productor por id
        $response = $this->get('/productores/' . $productor->documento_identidad);
        $response->assertStatus(200)->assertSee($productor->documento);

    }

    public function test_consulta_productor_id_invalido(): void
    {
        //Hacer las migraciones
        Artisan::call('migrate');
        //llenar la base de datos
        Artisan::call('db:seed');
        //obtener un productor invalido
        $productor = 'ab1';
        //traer un productor por id
        $response = $this->get('/productores/' . $productor);
        $response->assertStatus(500);
    }

    public function test_relation_productor_fincas(): void
    {
        //Hacer las migraciones
        Artisan::call('migrate');
        //llenar la base de datos
        Artisan::call('db:seed');
        //obtener un productor valido
        $productor = \App\Models\Productor::all()->first();
        //verificar que el productor tenga fincas
        $this->assertNotEmpty($productor->fincas);
    }
}
