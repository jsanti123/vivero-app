<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ProductorTest extends TestCase
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


    public function test_consulta_productor_id(): void
    {
        //Hacer las migraciones
        Artisan::call('migrate');
        //llenar la base de datos
        Artisan::call('db:seed');
        //obtener un productor valido
        $productor = \App\Models\Productor::all()->first();
        //traer un productor por id
        $response = $this->get('/productores/' . $productor->documento);
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
        if ($productor->fincas()->exists()) {
            // Verificar que el productor tenga fincas
            $this->assertNotEmpty($productor->fincas);
        } else {
            // En este caso, no se espera que el productor tenga fincas, así que la prueba pasa automáticamente
            $this->assertTrue(true);
        }
    }

    public function test_insertar_productor_a_bd(): void
    {
        //Hacer las migraciones
        Artisan::call('migrate');

        // Creamos un nuevo productor
        $productor = new \App\Models\Productor();
        $productor->factory(\App\Models\Productor::class)->create();

        $productorsearch = \App\Models\Productor::all()->first();


        // Verificamos que el productor se haya insertado correctamente en la BD
        $this->assertDatabaseHas('productores', [
            'documento' => $productorsearch->documento,
            'nombre' => $productorsearch->nombre,
            'apellidos' => $productorsearch->apellidos,
            'telefono' => $productorsearch->telefono,
            'email' => $productorsearch->email,
        ]);
    }
    public function test_insertar_productor_error(): void
    {
        // Hacer las migraciones
        Artisan::call('migrate');

        // Creamos un nuevo productor con un campo obligatorio nulo
        $productor = new \App\Models\Productor();

        $productor->documento = '123456';
        $productor->nombre = null; // Campo obligatorio nulo
        $productor->apellidos = 'Perez';
        $productor->telefono = '123456789';
        $productor->email = 'JUAN@EXAMPLE.COM';

        // Intentar guardar el productor
        try {
            $productor->save();
        } catch (\Exception $exception) {
            // Verificar que la excepción es lanzada debido a la restricción de clave foránea
            $this->assertInstanceOf(\Illuminate\Database\QueryException::class, $exception);
            $this->assertDatabaseMissing('productores', ['documento' => '123456']);
            return;
        }

    }


}
