@extends('layouts.app')

@section('botones')
    <a href="{{ route('recetas.create') }}" class="btn btn-primary mr-2 text-white">Crear receta</a>
    <a href="{{ route('perfils.edit', ['perfil' => $usuario->id]) }}" class="btn btn-success mr-2 text-white">Editar Perfil</a>
    <a href="{{ route('perfils.show', ['perfil' => $usuario->id]) }}" class="btn btn-info mr-2 text-white">Ver Mi Perfil</a>
@endsection

@section('content')

    <h2 class="text-center mb-2">Administra tus Recetas</h2>

    <div class="col-md-10 mx-auto bg-white p-3">
        <table class="table table-bordered">
            <thead class="bg-primary text-light">
                <tr>
                    <th scole="col">Titulo</th>
                    <th scole="col">Categoria</th>
                    <th scole="col">Acciones</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($recetas as $receta)
                    <tr>
                        <td>{{ $receta->titulo }}</td>
                        <td>{{ $receta->categoria->nombre }}</td>
                        <td>
                            <eliminar-receta
                                receta-id={{$receta->id}}
                            >
                            </eliminar-receta>

                            <a href="{{ route('recetas.edit', ['receta' => $receta->id]) }}" class="btn btn-sm d-block w-100 mb-2 btn-outline-dark mr-1">EDITAR</a>
                            <a href="{{ route('recetas.show', ['receta' => $receta->id]) }}" class="btn btn-sm d-block w-100 mb-2 btn-outline-success mr-1">VER</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="col-12 mt-4 justify-content-center d-flex">
            {!! $recetas->appends(request()->query())->links() !!}
        </div>

        <h2 class="text-center my-5">Recetas que te gustan</h2>

        @if (count($usuario->meGusta) > 0)
            <div class="col-md-10 mx-auto bg-white p-3">
                <ul class="list-group">
                    @foreach ($usuario->meGusta as $receta)
                        <li class="list-group-item d-flex justify-content-lg-between align-items-center">
                            <p>{{ $receta->titulo }}</p>
                            <a class="btn btn-outline-success" href="{{ route('recetas.show', ['receta' => $receta->id]) }}">Ver receta</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <p class="text-center">Aun no has dado me gusta a ninguna receta</p>
        @endif

    </div>

@endsection

