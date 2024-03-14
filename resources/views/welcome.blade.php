@extends('layouts.plantilla')

@section('titulo', 'Home')

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
        ">VIVEROS APP</h1>

        <a href="{{route('productor.index')}}" style="
            text-decoration: none;
            color: white;
            background-color: #4CAF50;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 10px;
            font-size: 20px;
            font-weight: bold;

        ">Productores</a>
        <a href="{{route('finca.index')}}" style="
            text-decoration: none;
            color: white;
            background-color: #4CAF50;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 10px;
            font-size: 20px;
            font-weight: bold;
        ">Fincas</a>
    </div>
@endsection
