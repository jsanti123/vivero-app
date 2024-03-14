@extends('layouts.plantilla')

@section('titulo', 'Finca ' . $finca->num_catastro . ' - ' . $finca->municipio)


@section('contenido')
    <a href="{{route('finca.index')}}" style="
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
        "> Finca - <span>{{$finca->num_catastro}}  {{$finca->municipio}}</span> </h1>

        <h2 style="
            color: white;
            font-size: 30px;
            font-weight: bold;
            background-color: #2E8B57;
            padding: 20px;
            border-radius: 10px;
        ">Productor a cargo: <a href="{{route('productor.show', $finca->productor->documento)}}">{{$finca->productor->nombre}}</a></h2>
        <h3 style="
            color: white;
            font-size: 30px;
            margin-top: 50px;
            font-weight: bold;
            border-radius: 10px;
        ">VIVEROS</h3>
        <div class="container mt-4">
            <div class="row justify-content-center">
                <table class="table table-striped table-hover">
                    <thead class="bg-primary text-white">
                        <th>CODIGO</th>
                        <th>CULTIVO</th>
                        <th>LABORES</th>
                    </thead>
                    <tbody>
                        @foreach ($finca->viveros as $vivero)
                            <tr>
                                <td>{{ $vivero->codigo }}</td>
                                <td>{{ $vivero->cultivo }}</td>
                                <td><a href="{{route('finca.labores', ['codigo' => $vivero->codigo])}}">{{ $vivero->countLabores()}}</a></td>
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
