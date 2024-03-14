@extends('layouts.plantilla')

@section('titulo', 'Labores '. $vivero->codigo . ' - ' . $vivero->cultivo)

@section('contenido')
    <a href="{{route('finca.show', ['num_catastro' => $vivero->finca->num_catastro, 'municipio' => $vivero->finca->municipio])}}" style="
    text-decoration: none;
    color: white;
    padding: 10px;
    border-radius: 5px;
    margin: 10px;
    font-size: 20px;
    font-weight: bold;"
    ">Volver</a>
    <div style="
    display: flex;
    flex-direction: column;
    align-items: center;
    ">
    <h1 style="
        color: white;
        font-size: 50px;
        margin: 50px;
        font-weight: bold;
    "> Labores</h1>

        <div class="container mt-4">
            <div class="row justify-content-center">
                <h2 style="
                    color: white;
                    font-size: 30px;
                    font-weight: bold;
                    ">Finca: {{$vivero->finca->num_catastro}} - {{$vivero->finca->municipio}}</h2>
                <h3 style="
                    color: white;
                    font-size: 25px;
                    font-weight: bold;
                ">Vivero: {{$vivero->codigo}} - {{$vivero->cultivo}}</h3>
                <table class="table table-striped table-hover">
                    <thead class="bg-primary text-white">
                        <th>CODIGO</th>
                        <th>FECHA</th>
                        <th>DESCRIPCION</th>
                        <th>PRODUCTOS</th>
                    </thead>
                    <tbody>
                        @foreach ($vivero->labores as $labor)
                            <tr>
                                <td>{{ $labor->id }}</td>
                                <td>{{ $labor->fecha }}</td>
                                <td>{{ $labor->descripcion }}</td>
                                <td>
                                    @foreach ($labor->productos as $producto)
                                        <a href="{{route('finca.productos', ['labor' => $labor->id, 'codigo' => $producto->ICA ])}}"> {{ $producto->nombre }}</a>
                                        <span> - </span>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                        <!--
                        {{--@foreach ($curso->users as $registro)
                            <tr>
                                <td><a href="{{route('perfil.index', $registro->id)}}"> {{ $registro->name }} </a></td>
                                <td>{{ $registro->email }}</td>
                            </tr>
                        @endforeach
                        --}}
                        -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection