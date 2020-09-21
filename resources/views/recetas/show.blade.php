@extends('layouts.app')

@section('content')

<article class="contenido-receta bg-white p-5 shadow">

    <h1 class="text-center mb-4">{{ $receta->titulo }}</h1>

    <div class="imagen-receta">
        <img class="w-100 mb-3" src="/storage/{{ $receta->imagen }}" alt="">
    </div>

    <div class="receta-meta mt-3">
        <p>
            <span class="font-weight-bold text-primary">Escrito en:</span>
            <a class="text-dark" href="{{ route('categorias.show', $receta->categoria->id) }}">{{ $receta->categoria->nombre }}</a>
        </p>

        <p>
            <span class="font-weight-bold text-primary">Autor:</span>
            <a class="text-dark" href="{{ route('perfils.show', $receta->autor->id) }}">{{ $receta->autor->name }}</a>

        </p>

        <p>
            <span class="font-weight-bold text-primary">Fecha:</span>
            @php
                $fecha = $receta->created_at;
            @endphp

            <fecha-receta fecha="{{ $fecha }}"></fecha-receta>
        </p>
    </div>

    <div class="ingredientes">
        <h2 class="my-3 text-primary">Ingredientes</h2>
        {!! $receta->ingredientes !!}
    </div>

    <div class="ingredientes">
        <h2 class="my-3 text-primary">Preparación</h2>
        {!! $receta->preparacion !!}
    </div>

    <div class="justify-content-center row text-center">
        <like-button
            receta-id="{{ $receta->id }}"
            like="{{ $like }}"
            likes="{{ $likes }}">
        </like-button>
    </div>

</article>

@endsection
