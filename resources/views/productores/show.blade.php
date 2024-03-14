@extends('layouts.plantilla')

@section('titulo', 'Productor ' . $productor->nombre . ' ' . $productor->apellidos)


@section('contenido')
    <a href="{{route('productor.index')}}" style="
        text-decoration: none;
        color: white;
        padding: 10px;
        border-radius: 5px;
        margin: 10px;
        font-size: 20px;
        font-weight: bold;"
    >Volver</a>

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
            background-color: #1c7430;
            padding: 20px;
            border-radius: 10px;
        ">Productor:  <span> {{$productor->nombre}} {{$productor->apellidos}}</span></h1>
        <h3 style="
            color: white;
            font-size: 30px;
            font-weight: bold;
            padding: 10px;
            border-radius: 10px;
        ">Fincas a su cargo</h3>
        <div class="container mt-4">
            <div class="row justify-content-center">
                <table class="table table-striped table-hover">
                    <thead class="bg-primary text-white">
                        <th># DE CATASTRO</th>
                        <th>MUNICIPIO</th>
                    </thead>
                    <tbody>
                        @foreach ($productor->fincas as $finca)
                            <tr>
                                <td><a href="{{route('finca.show', ['num_catastro' => $finca->num_catastro, 'municipio' => $finca->municipio])}}"> {{ $finca->num_catastro }} </a></td>
                                <td>{{ $finca->municipio }}</td>
                            </tr>
                        <!--
                        {{--@foreach ($curso->users as $registro)
                            <tr>
                                <td><a href="{{route('perfil.index', $registro->id)}}"> {{ $registro->name }} </a></td>
                                <td>{{ $registro->email }}</td>
                            </tr>
                        @endforeach
                        --}}
                        -->
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
@endsection