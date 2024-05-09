<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

class ViveroFormTest extends TestCase
{
    public function test_exito_formulario_vivero(){

        //Hacer las migraciones
        Artisan::call('migrate');
        //llenar la base de datos
        Artisan::call('db:seed');

        $finca = \App\Models\Finca::all()->first();

        $response = $this->post('/Viveros',
            [
                'vivero' => 'Pera',
                'municipio' => $finca->municipio,
                'num_catastro' => $finca->num_catastro,
            ]
        );

        $response->assertStatus(302);

        $location = $response->headers->get('Location');

        $response = $this->get($location)->assertStatus(200)->assertSee('Vivero agregado correctamente');
    }

    public function test_error_informacion_incorrecta(){

        //Hacer las migraciones
        Artisan::call('migrate');
        //llenar la base de datos
        Artisan::call('db:seed');

        $finca = \App\Models\Finca::all()->first();

        $response = $this->post('/Viveros',
            [
                'vivero' => 'Pera123',
            ]
        );

        //verificar que se estan validando los campos
        $response->assertSessionHasErrors(['vivero'])->assertStatus(302);
        //verificar que se esta mostrando el mensaje de error
        $response->assertSessionHasErrors(['vivero' => 'La información es incorrecta, el campo de vivero no tiene el formato correcto']);
    }
}
