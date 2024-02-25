@extends('layouts.app-master')

@section('content')
    @auth

        <div class="container-fluid d-flex justify-content-center align-items-center vh-80 mt-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center mb-4">Subir nueva imagen</p>

                    <form action="{{ route('imagenes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-outline mb-4">
                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre de la imagen">
                            @error('nombre')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-outline mb-4">
                            <input type="file" class="form-control" name="imagen" id="imagen">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary btn-block" name="enviar" id="enviar">Enviar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    @endauth

    @guest
        <p><a href="/login">Inicia sesión</a> para ver el contenido</p>
    @endguest

@endsection
