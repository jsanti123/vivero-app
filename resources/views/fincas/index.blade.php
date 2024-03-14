@extends('layouts.plantilla')


@section('titulo', 'Fincas')



@section('contenido')
<a href="{{route('vivero.index')}}" style="
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
    ">FINCAS</h1> 
    <div class="container mt-4">
        <div class="row justify-content-center">
            <table class="table table-striped table-hover">
                <thead class="bg-primary text-white">
                    <th># DE CATASTRO</th>
                    <th>MUNICIPIO</th>
                </thead>
                <tbody>
                    @foreach ($fincas as $finca)
                        <tr>
                            <td><a href="{{route('finca.show', ['num_catastro' => $finca->num_catastro, 'municipio' => $finca->municipio])}}"> 
                                {{ $finca->num_catastro }} </a></td>
                            <td>{{ $finca->municipio }}</td>
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