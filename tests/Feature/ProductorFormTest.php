<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

class ProductorFormTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_exito_formulario_productor(): void
    {

        //Hacer las migraciones
        Artisan::call('migrate');
        //llenar la base de datos
        Artisan::call('db:seed');

        $response = $this->post('/productores',
            [
                'documento' => '123456789',
                'nombre' => 'Juan',
                'apellido' => 'Perez',
                'telefono' => '123456789',
                'email' => 'santgt123@gmail.com',
            ]
        );

        $response->assertStatus(302);

        $location = $response->headers->get('Location');
        $response = $this->get($location)->assertStatus(200)->assertSee('Productor agregado correctamente');

    }

    public function test_error_informacion_incorrecta(): void
    {
        //Hacer las migraciones
        Artisan::call('migrate');
        //llenar la base de datos
        Artisan::call('db:seed');

        $response = $this->post('/productores',
            [
                'documento' => '-123456789',
                'nombre' => 'Juan1',
                'apellido' => 'Perez123',
                'telefono' => '-123456789',
                'email' => 'santgt123gmail.com',
            ]
        );

        //verificar que se estan validando los campos
        $response->assertSessionHasErrors(['documento', 'nombre', 'apellido', 'telefono', 'email'])->assertStatus(302);
        //verificar que se esta mostrando el mensaje de error
        $response->assertSessionHasErrors(['documento' => 'La información es incorrecta, el documento debe ser mayor a 0',
            'nombre' => 'La información es incorrecta, el campo de nombre no tiene el formato correcto',
            'apellido' => 'La información es incorrecta, el campo de apellido no tiene el formato correcto',
            'telefono' => 'La información es incorrecta, el telefono debe ser mayor a 0',
            'email' => 'La información es incorrecta, el campo de email no tiene el formato correcto']);
            
    }
}
