@extends('layouts.plantilla')


@section('titulo', 'Productores')


@section('contenido')
    <a href="{{route('vivero.index')}}" style="
        text-decoration: none;
        color: white;
        padding: 10px;
        border-radius: 5px;
        margin: 10px;
        font-size: 20px;
        font-weight: bold;
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
        ">PRODUCTORES</h1>
        <div class="container mt-4">
            <div class="row justify-content-center">
                <table class="table table-striped table-hover">
                    <thead class="bg-primary text-white">
                        <th>DOCUMENTO</th>
                        <th>NOMBRE</th>
                        <th>APELLIDOS</th>
                        <th>TELEFONO</th>
                        <th>EMAIL</th>
                    </thead>
                    <tbody>
                        @foreach ($productores as $productor)
                            <tr>
                                <td><a href="{{route('productor.show', $productor->documento)}}"> {{ $productor->documento }} </a></td>
                                <td>{{ $productor->nombre }}</td>
                                <td>{{ $productor->apellidos }}</td>
                                <td>{{ $productor->telefono }}</td>
                                <td>{{ $productor->email }}</td>
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