@extends('layouts.app-master')

@section('content')
    <h1>Hola!</h1>

    @auth
        <p>Bienvenido {{ auth()->user()->name }}, estás autenticado.</p>

        @if (!empty($imagenes))
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($imagenes as $imagen)
                        <tr>
                            <th scope="row">{{ $imagen->id }}</th>
                            <td>
                                <img src="{{ $imagen->imagen }}" alt="Imagen" style="max-width: 100px;">
                            </td>
                            <td>{{ $imagen->nombre }}</td>
                            <td>
                                <a href="#">Editar</a> |
                                <a href="#">Eliminar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No hay imágenes disponibles.</p>
        @endif

        <a href="/imagenes/create" class="btn btn-primary">Nueva Imagen</a>

    @endauth

    @guest
        <p><a href="/login">Inicia sesión</a> para ver el contenido</p>
    @endguest
@endsection
