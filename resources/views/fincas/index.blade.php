@extends('layouts.plantilla')
@vite(['resources/css/finca/showFinca.css', 'resources/js/finca/showFinca.js'])

@section('titulo', 'Fincas')



@section('contenido')

<div class="container my-4">
    <div class="row text-center my-4">
        <div class="col">
            <h1 class="title-finca">FINCAS</h1>
        </div>
    </div>
    <div class="row text-center my-4">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover rounded-sm">
                    <thead>
                    <tr class="table text-center">
                        <th scope="col"># DE CATASTRO</th>
                        <th scope="col">MUNICIPIO</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($fincas as $finca)
                            <tr>
                                <th scope="row" class="text-center"><a href="{{route('finca.show', ['num_catastro' => $finca->num_catastro, 'municipio' => $finca->municipio])}}"> 
                                    {{ $finca->num_catastro }} </a></td>
                                <td>{{ $finca->municipio }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-center align-items-center">
                {{ $fincas->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
</div>

@endsection