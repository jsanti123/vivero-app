<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vivero;

class ViveroController extends Controller
{
    public function store(Request $request) {

        $request->validate([
                'vivero' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            ],
            [
                'vivero.required' => 'El campo vivero es obligatorio',
                'vivero.string' => 'El campo vivero debe ser una cadena de texto',
                'vivero.max' => 'El campo vivero no debe exceder los 255 caracteres',
                'vivero.regex' => 'La información es incorrecta, el campo de vivero no tiene el formato correcto',
            ]

        );

        # Generar el codigo unico de identificacion de max 10 numeros
        $codigo = rand(1000000000, 9999999999);

        #validar que el codigo no exista en la base de datos
        while (Vivero::where('codigo', (string)$codigo)->exists()) {
            $codigo = rand(1000000000, 9999999999);
        }

        $vivero = new Vivero();

        $vivero->codigo = (string)$codigo;
        $vivero->cultivo = $request->vivero;
        $vivero->num_catastro = (string)$request->num_catastro;
        $vivero->municipio = (string)$request->municipio;

        //verficar si se guardo correctamente
        try {
            $vivero->save();
            //devolverme nuevamente a la vista de la finca
            return redirect()->route('finca.show', [$vivero->num_catastro, $vivero->municipio])->with('mensaje', 'Vivero agregado correctamente');         
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
