@extends('layouts.plantilla')
@vite(['resources/css/finca/showOneFinca.css', 'resources/js/finca/showOneFinca.js'])

@section('titulo', 'Finca ' . $finca->num_catastro . ' - ' . $finca->municipio)


@section('contenido')
    <div class="container my-3 cont-section">
        <div class="row">
            <div class="col-8">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1 class="title-finca-viveros"> Finca - <span>{{$finca->num_catastro}} {{$finca->municipio}}</span></h1>
                    </div>
                    <div class="col-12 text-center">
                        <h2 class="title-productor-finca">Productor a cargo: <a href="{{route('productor.show', $finca->productor->documento)}}">{{$finca->productor->nombre}}</a></h2>
                    </div>
                    <div class="col-12 text-center">
                        <h3 class="title-viveros">
                            VIVEROS
                        </h3>
                    </div>
                    <div class="col-12 text-center">
                        <div class="table-responsive">
                            <table class="table table-dark table-striped table-hover rounded-sm">
                                <thead>
                                <tr class="table text-center">
                                    <th scope="col">CODIGO</th>
                                    <th scope="col">CULTIVO</th>
                                    <th scope="col">LABORES</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($viveros as $vivero)
                                        <tr>
                                            <td class="text-center">{{$vivero->codigo}}</td>
                                            <td class="text-center">{{ $vivero->cultivo }}</td>
                                            <td class="text-center"><a href="{{route('finca.labores', ['codigo' => $vivero->codigo])}}">{{ $vivero->countLabores()}}</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col d-flex justify-content-center align-items-center">
                            {{ $viveros->onEachSide(1)->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row my-3">
                    <div class="col">
                        <div class="container form-vivero">
                            <h2 class="text-center title-form-vivero">Agregar Vivero</h2>
                            {{-- Mostrar errores si existen --}}
                            <form action="{{route('vivero.store')}}" method="POST" class="row">
            
                                @csrf
            
                                <div class="col-12 my-2">
                                    <label class="form-label text-form-vivero">Tipo de cultivo</label>
                                    <input type="text" class="form-control" placeholder="Ingrese el tipo de cultivo aqui" name="vivero" value="{{old('vivero')}}">
            
                                    @error('vivero')
                                        <div class="alert alert-danger my-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!--un input escondido donde le mande el  municipio y el # de catastro-->
                                <input type="hidden" name="municipio" value="{{$finca->municipio}}">
                                <input type="hidden" name="num_catastro" value="{{$finca->num_catastro}}">
            
                                <div class="col-12 my-3">
                                    @if (session('mensaje'))
                                        @if (session('mensaje') == 'Vivero agregado correctamente')
                                            <div class="alert alert-success my-2">
                                                {{ session('mensaje') }}
                                            </div>
                                        @else
                                            <div class="alert alert-danger my-2">
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
        </div>
    </div>
@endsection
