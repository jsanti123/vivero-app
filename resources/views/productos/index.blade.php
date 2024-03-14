@extends('layouts.plantilla')

@section('titulo', 'Producto ' . $producto->nombre)


@section('contenido')
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
        "> Producto: {{$producto->nombre}}</h1>
        <div class="container mt-4">
            <div class="row justify-content-center">
                <table class="table table-striped table-hover">
                    <thead class="bg-primary text-white">
                        <th>ICA</th>
                        <th>FRECUENCIA</th>
                        <th>VALOR</th>
                        <th>PERIODO DE CARENCIA</th>
                        <th>ULTIMA FECHA DE APLICACION</th>
                        <th>HONGO</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $producto->ICA }}</td>
                            <td>{{ $producto->frecuencia }}</td>
                            <td>{{ $producto->valor }}</td>
                            <td>{{ $productoLabor->pivot->periodo_carencia }}</td>
                            <td>{{ $productoLabor->pivot->fecha_ultima_aplicacion }}</td>
                            <td>{{ $productoLabor->pivot->hongo }}</td>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection