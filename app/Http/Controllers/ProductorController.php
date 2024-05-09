<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productor;

class ProductorController extends Controller
{
    public function index()
    {

        $productores = Productor::paginate(6);

        return view('productores.index', compact('productores'));
    }

    public function show($documento)
    {
        $productor = Productor::find($documento);

        return view('productores.show', compact('productor'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'documento' => ['required', 'unique:productores,documento', 'numeric', 'min:0'],
            'nombre' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'apellido' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'telefono' => ['required', 'numeric', 'min:0'],
            'email' => ['required', 'email'],
        ],
        [
            'documento.required' => 'El campo documento es obligatorio',
            'documento.unique' => 'El documento ya existe en el sistema',
            'documento.numeric' => 'El documento debe ser un número',
            'documento.min' => 'La información es incorrecta, el documento debe ser mayor a 0',
            'nombre.required' => 'El campo nombre es obligatorio',
            'nombre.regex' => 'La información es incorrecta, el campo de nombre no tiene el formato correcto',
            'apellido.required' => 'El campo apellido es obligatorio',
            'apellido.regex' => 'La información es incorrecta, el campo de apellido no tiene el formato correcto',
            'telefono.required' => 'El campo telefono es obligatorio',
            'telefono.numeric' => 'El telefono debe ser un número',
            'telefono.min' => 'La información es incorrecta, el telefono debe ser mayor a 0',
            'email.required' => 'El campo email es obligatorio',
            'email.email' => 'La información es incorrecta, el campo de email no tiene el formato correcto',
        ]
        
    );

        $productor = new Productor();

        $productor->documento = (string)$request->documento;
        $productor->nombre = $request->nombre;
        $productor->apellidos = $request->apellido;
        $productor->telefono = (string)$request->telefono;
        $productor->email = (string)$request->email;

        //verficar si se guardo correctamente
        try {
            $productor->save();
            return redirect()->route('productor.index')->with('mensaje', 'Productor agregado correctamente');
        } catch (\Exception $e) {
            return redirect()->route('productor.index')->with('mensaje', 'Error al agregar el productor');
        }
    }
}
