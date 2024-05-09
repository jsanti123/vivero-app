@extends('layouts.plantilla')
@vite(['resources/css/productor/showProductor.css', 'resources/js/productor/showProductor.js'])

@section('titulo', 'Productores')


@section('contenido')
<div class="container my-4">
    <div class="row text-center my-4">
        <div class="col">
            <h1 class="title-productor">PRODUCTOR</h1>
        </div>
    </div>
    <div class="row my-4">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover rounded-sm">
                    <thead>
                    <tr class="table text-center">
                        <th>DOCUMENTO</th>
                        <th>NOMBRE</th>
                        <th>APELLIDOS</th>
                        <th>TELEFONO</th>
                        <th>EMAIL</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($productores as $productor)
                            <tr>
                                <th scope="row" class="text-center"><a href="{{route('productor.show', ['productor' => $productor->documento])}}"> 
                                    {{ $productor->documento }} </a></td>
                                <td class="text-center">{{ $productor->nombre }}</td>
                                <td class="text-center">{{ $productor->apellidos }}</td>
                                <td class="text-center">{{ $productor->telefono }}</td>
                                <td class="text-center">{{ $productor->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col d-flex justify-content-center align-items-center">
                {{ $productores->onEachSide(1)->links() }}
            </div>
        </div>
        <div class="col">
            <div class="container form-productor">
                <h2 class="text-center title-form-productor">Agregar Productor</h2>
                <form action="{{route('productor.store')}}" method="POST" class="row">

                    @csrf

                    <div class="col-12 my-2">
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label text-form-productor">Nombre</label>
                                <input type="text" class="form-control" placeholder="Ingrese tu nombre" name="nombre" value="{{old('nombre')}}">

                                @error('nombre')
                                    <div class="alert alert-danger my-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-8">
                                <label class="form-label text-form-productor">Apellidos</label>
                                <input type="text" class="form-control" placeholder="Ingrese tus apellidos" name="apellido" value="{{old('apellido')}}">

                                @error('apellido')
                                    <div class="alert alert-danger my-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>                       
                    </div>

                    <div class="col-12 my-2">
                        <label class="form-label text-form-productor"># de documento</label>
                        <input type="number" class="form-control" placeholder="Ingrese el numero de documento" name="documento" value="{{old('documento')}}">

                        @error('documento')
                            <div class="alert alert-danger my-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 my-2">
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label text-form-productor"># de telefono</label>
                                <input type="number" class="form-control" placeholder="Ingrese el numero de telefono" name="telefono" value="{{old('telefono')}}">
                                
                                @error('telefono')
                                    <div class="alert alert-danger my-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-8">
                                <label class="form-label text-form-productor">Correo electronico</label>
                                <input type="email" class="form-control" placeholder="Ingrese el email" name="email" value="{{old('email')}}">
                                
                                @error('email')
                                    <div class="alert alert-danger my-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-12 my-3">
                        @if (session('mensaje'))
                            @if (session('mensaje') == 'Productor agregado correctamente')
                                <div class="alert alert-success my-2">
                                    {{ session('mensaje') }}
                                </div>
                            @else
                                <div class="alert alert-success my-2">
                                    {{ session('mensaje') }}
                                </div>
                            @endif
                        @endif
                    </div>
                    <div class="col-12 my-2 text-center">
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection