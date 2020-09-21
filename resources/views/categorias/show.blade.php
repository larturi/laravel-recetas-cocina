@extends('layouts.app')


@section('content')

    <div class="container">
        <h2 class="titulo-categoria text-uppercase mt-3 mb2">{{ $categoriaReceta->nombre }}</h2>
    </div>

    <div class="row">
        @foreach ($recetas as $receta)
            @include('ui.receta')
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="col-12 mt-4 justify-content-center d-flex">
        {!! $recetas->appends(request()->query())->links() !!}
    </div>

@endsection
