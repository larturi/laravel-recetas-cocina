@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
@endsection

@section('hero')
    <div class="hero-categorias">
        <form class="container h-100" action="{{ route('buscar.show') }}">
            <div class="row h-100 align-items-center">
                <div class="col-md-4 texto-buscar">
                    <p class="display-4">Encuentra una receta para tu proxima comida</p>
                    <input type="search" name="buscar" class="form-control" placeholder="Buscar Receta">
                </div>
            </div>
        </form>
    </div>
@endsection


@section('content')

<div class="container nuevas-recteas">
    <h2 class="titulo-categoria text-uppercase mt-4 mb-3">Ultimas recetas</h2>

    <div class="owl-carousel owl-theme">
        @foreach ($nuevas as $receta)
            <div class="card">
                <img src="/storage/{{ $receta->imagen }}" class="card-img-top">

                <div class="card-body d-flex flex-column">
                    <h3>{{ $receta->titulo }}</h3>

                    <p>{{ Str::words(strip_tags($receta->preparacion), 20) }}</p>

                    <a class="btn btn-primary mt-auto d-block text-uppercase " href="{{ route('recetas.show', ['receta' => $receta->id]) }}">Ver receta</a>
                </div>
            </div>
        @endforeach
    </div>

</div>

<div class="container">
    <h2 class="titulo-categoria text-uppercase mt-4 mb-3">Recetas mas votadas</h2>

    <div class="row">
        @foreach ($votadas as $receta)
            @include('ui.receta')
        @endforeach
    </div>
</div>

@foreach ($recetas as $key => $grupo)

    <div class="container">
        <h2 class="titulo-categoria text-uppercase mt-4 mb-3">{{ str_replace('-', ' ', $key) }}</h2>

        <div class="row">
            @foreach ($grupo as $recetas)

                @foreach ($recetas as $receta)
                    @include('ui.receta')
                @endforeach

            @endforeach
        </div>
    </div>

@endforeach

@endsection
