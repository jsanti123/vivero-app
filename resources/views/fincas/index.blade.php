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
    <div class="row my-4">
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
                                <td class="text-center">{{ $finca->municipio }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col d-flex justify-content-center align-items-center">
                {{ $fincas->onEachSide(1)->links() }}
            </div>
        </div>
        <div class="col">
            <div class="container form-finca">
                <h2 class="text-center title-form-finca">Agregar Finca</h2>
                {{-- Mostrar errores si existen --}}
                <form action="{{route('finca.store')}}" method="POST" class="row">

                    @csrf

                    <div class="col-12 my-2">
                        <select name="productor" class="form-select">
                            <option value="" {{ old('productor') == '' ? 'selected' : '' }}>Elije un productor</option>
                            @foreach ($productores as $productor)
                                <option value="{{ $productor->documento }}" {{ old('productor') == $productor->documento ? 'selected' : '' }}>
                                    {{ $productor->nombre }}
                                </option>
                            @endforeach
                        </select>                        
            
                        @error('productor')
                            <br>
                            <div class="alert alert-danger my-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 my-2">
                        <label for="Catastro" class="form-label text-form-finca"># de catastro</label>
                        <input type="number" class="form-control" placeholder="Ingrese el numero de catastro aquí" name="catastro" value="{{old('catastro')}}">

                        @error('catastro')
                            <div class="alert alert-danger my-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 my-2">
                        <label class="form-label text-form-finca">Municipio</label>
                        <input type="text" class="form-control" placeholder="Ingrese el municipio aquí" name="municipio" value="{{old('municipio')}}">

                        @error('municipio')
                            <div class="alert alert-danger my-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 my-3">
                        @if (session('mensaje'))
                            @if (session('mensaje') == 'Finca agregada correctamente')
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

                    <div class="col-12 my-3 text-center">
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection