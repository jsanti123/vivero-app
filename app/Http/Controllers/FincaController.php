<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Finca;
use App\Models\Vivero;
use App\Models\Productor;
use App\Models\ProductosControl;

class FincaController extends Controller
{
    public function index()
    {
        $fincas = Finca::paginate(8);
        $productores = Productor::all();

        return view('fincas.index', compact('fincas', 'productores'));
    }

    public function show($num_catastro, $municipio)
    {
        $finca = Finca::where('num_catastro', $num_catastro)
            ->where('municipio', $municipio)
            ->first();

        return view('fincas.show', compact('finca'));
    }

    public function store(Request $request){
        $request->validate([
            'productor' => ['required', 'exists:productores,documento'],
            'catastro' => ['required', 'unique:fincas,num_catastro', 'numeric', 'min:0'],
            'municipio' => ['required','regex:/^[a-zA-Z\s]+$/'],
        ],
        [
            'productor.required' => 'El campo productor es obligatorio',
            'productor.exists' => 'El productor no existe',
            'catastro.required' => 'El campo catastro es obligatorio',
            'catastro.unique' => 'La finca ya existe en el sistema',
            'catastro.numeric' => 'El catastro debe ser un número',
            'catastro.min' => 'La información es incorrecta, el catastro debe ser mayor a 0',
            'municipio.required' => 'El campo municipio es obligatorio',
            'municipio.regex' => 'La información es incorrecta, el campo de municipio no tiene el formato correcto',
        ]
    );

        $finca = new Finca();

        $finca->num_catastro = $request->catastro;
        $finca->municipio = $request->municipio;
        $finca->productores_id = $request->productor;

        //verficar si se guardo correctamente
        try {
            $finca->save();
            return redirect()->route('finca.index')->with('mensaje', 'Finca agregada correctamente');
        } catch (\Exception $e) {
            return redirect()->route('finca.index')->with('mensaje', 'Error al agregar la finca');
        }

    }

    public function labores($codigo)
    {
        $vivero = Vivero::where('codigo', $codigo)->first();

        return view('labores.index', compact('vivero'));
    }

    public function producto($labor, $codigo)
    {
        $producto = ProductosControl::where('ICA', $codigo)->first();

        $productoLabor = $producto->labores()->where('labor_id', $labor)->first();

        return view('productos.index', compact('producto', 'productoLabor'));
    }

}
