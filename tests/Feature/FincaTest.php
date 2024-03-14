<?php

namespace Tests\Feature;

use App\Models\Finca;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class FincaTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_consulta_finca(): void
    {
        //Hacer las migraciones
        Artisan::call('migrate');
        //llenar la base de datos
        Artisan::call('db:seed');
        //traer todas las fincas
        $response = $this->get('/fincas');
        $response->assertStatus(200)->assertSee('fincas');
    }

    public function test_consulta_finca_id(): void
    {
        //Hacer las migraciones
        Artisan::call('migrate');
        //llenar la base de datos
        Artisan::call('db:seed');
        //obtener una finca valida
        $finca = \App\Models\Finca::all()->first();
        //traer una finca por id
        $response = $this->get('/fincas/' . $finca->id);
        $response->assertStatus(200)->assertSee($finca->id);
    }

    public function test_consulta_finca_id_invalido(): void
    {
        //Hacer las migraciones
        Artisan::call('migrate');
        //llenar la base de datos
        Artisan::call('db:seed');
        //obtener una finca invalida
        $finca = new Finca();
        $finca->num_catastro = 'ab1';
        $finca->municipio = 'municipio';

        //traer una finca por id
        $response = $this->get('/fincas/' . $finca->num_catastro . '/' . $finca->municipio);
        $response->assertStatus(500);
    }

    public function test_relation_finca_productor(): void
    {
        //Hacer las migraciones
        Artisan::call('migrate');
        //llenar la base de datos
        Artisan::call('db:seed');
        //obtener una finca valida
        $finca = \App\Models\Finca::all()->first();
        
        $this->assertNotEmpty($finca->productor);
        $this->assertNotEmpty($finca->viveros());
    }
}
