@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-3 mx-auto text-center mt-4">
            @if ($perfil->imagen)
              <img src="/storage/{{ $perfil->imagen }}" class="w-75 rounded-circle">
            @else
              <img src="/storage/upload-perfiles/default.jpeg" class="w-75 rounded-circle">
            @endif
        </div>

        <div class="col-md-9 mt-3 mt-md-0">
           <h2 class="text-center mb-4 text-primary mt-2">{{ $perfil->usuario->name }}</h2>
           <a href="{{ $perfil->usuario->url }}">Visitar Sitio Web</a>
           <div class="biografia">
            {!! $perfil->biografia !!}
           </div>
        </div>
    </div>
</div>

<h2 class="text-center my-4">Recetas creadas por {{ $perfil->usuario->name }}</h2>

<div class="container">
    <div class="row mx-auto bg-white p-4">
        @if (count($recetas) > 0)
            @foreach ($recetas as $receta)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img class="card-img-top" src="/storage/{{ $receta->imagen }}" alt="">
                        <div class="card-body">
                            <h4 class="card-title">{{ $receta->titulo }}</h4>
                            <a class="btn btn-primary btn-sm mt-3 d-block text-uppercase font-weight-bold"
                               href="{{ route('recetas.show', ['receta' => $receta->id])  }}">Ver Receta</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center">EL usuario no ha publicado recetas</p>
        @endif
    </div>

    {{-- Pagination --}}
    <div class="col-12 mt-4 justify-content-center d-flex">
        {!! $recetas->appends(request()->query())->links() !!}
    </div>

</div>

@endsection
