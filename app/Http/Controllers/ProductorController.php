<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productor;

class ProductorController extends Controller
{
    public function index()
    {

        $productores = Productor::all();

        return view('productores.index', compact('productores'));
    }

    public function show($documento)
    {
        $productor = Productor::find($documento);

        return view('productores.show', compact('productor'));
    }
}
