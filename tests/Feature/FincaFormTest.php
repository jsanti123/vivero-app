<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

class FincaFormTest extends TestCase
{
    public function test_exito_formulario_finca(): void
    {
        //Hacer las migraciones
        Artisan::call('migrate');
        //llenar la base de datos
        Artisan::call('db:seed');

        $productor = \App\Models\Productor::all()->first();

        $response = $this->post('/fincas',
            [
                'productor' => $productor->documento,
                'catastro' => '123456789',
                'municipio' => 'Bogota',
            ]
        );

        $response->assertStatus(302);

        $location = $response->headers->get('Location');
        $response = $this->get($location)->assertStatus(200)->assertSee('Finca agregada correctamente');

    }

    public function test_error_informacion_incorrecta(): void
    {
        //Hacer las migraciones
        Artisan::call('migrate');
        //llenar la base de datos
        Artisan::call('db:seed');

        $productor = \App\Models\Productor::all()->first();

        $response = $this->post('/fincas',
            [
                'productor' => $productor->documento,
                'catastro' => '-123456789',
                'municipio' => 'Bogotá',
            ]
        );

        //verificar que se estan validando los campos
        $response->assertSessionHasErrors(['catastro', 'municipio'])->assertStatus(302);
        //verificar que se esta mostrando el mensaje de error
        $response->assertSessionHasErrors(['catastro' => 'La información es incorrecta, el catastro debe ser mayor a 0', 'municipio' => 'La información es incorrecta, el campo de municipio no tiene el formato correcto']);

    }
}
