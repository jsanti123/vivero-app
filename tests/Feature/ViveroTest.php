<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use \App\Models\Finca;
use \App\Models\Vivero;
use Tests\TestCase;

class ViveroTest extends TestCase

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

    public function test_consulta_vivero(): void
    {
        //Hacer las migraciones
        Artisan::call('migrate');
        //llenar la base de datos
        Artisan::call('db:seed');

        //trar un vivero
        $vivero = \App\Models\Vivero::all()->first();

        //traer todos los viveros
        $response = $this->get('/fincas/vivero/labores/'.$vivero->codigo);
        $response->assertStatus(200);
    }


    public function test_insertar_vivero_a_bd(): void
    {
        //Hacer las migraciones
        Artisan::call('migrate');
        //llenar la base de datos
        Artisan::call('db:seed');

        //obtener una finca valida
        $finca = \App\Models\Finca::all()->first();
        //crear un vivero
        $vivero = new Vivero();
        $vivero->codigo = '123';
        $vivero->cultivo = 'uva';
        $vivero->num_catastro = $finca->num_catastro;
        $vivero->municipio = $finca->municipio;

        //guardar el vivero
        $vivero->save();

        //verificar que el vivero se haya creado
        $this->assertDatabaseHas('viveros', 
        [
            'codigo' => '123',
            'cultivo' => 'uva',
            'num_catastro' => $finca->num_catastro,
            'municipio' => $finca->municipio
        ]);

    }

    public function test_editar_vivero_a_bd(): void
    {
        //Hacer las migraciones
        Artisan::call('migrate');
        //llenar la base de datos
        Artisan::call('db:seed');

        //obtener un vivero valido
        $vivero = \App\Models\Vivero::all()->first();
        //editar el vivero
        $vivero->codigo = '321';
        $vivero->cultivo = 'papa';
        //guardar el vivero
        $vivero->save();

        //verificar que el vivero se haya editado
        $this->assertDatabaseHas('viveros', 
        [
            'codigo' => '321',
            'cultivo' => 'papa'
        ]);

    }

    public function test_conexion_vivero_finca(): void
    {
        //Hacer las migraciones
        Artisan::call('migrate');
        //llenar la base de datos
        Artisan::call('db:seed');

        //obtener un vivero valido
        $vivero = \App\Models\Vivero::all()->first();
        //verificar que el vivero tenga una finca
        $this->assertNotEmpty($vivero->finca);
    }

}
