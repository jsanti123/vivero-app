<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Finca;
use App\Models\Vivero;
use App\Models\ProductosControl;

class FincaController extends Controller
{
    public function index()
    {
        $fincas = Finca::paginate(5);

        return view('fincas.index', compact('fincas'));
    }

    public function show($num_catastro, $municipio)
    {
        $finca = Finca::where('num_catastro', $num_catastro)
            ->where('municipio', $municipio)
            ->first();

        return view('fincas.show', compact('finca'));
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
