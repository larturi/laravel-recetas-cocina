@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.min.css" integrity="sha512-sC2S9lQxuqpjeJeom8VeDu/jUJrVfJM7pJJVuH9bqrZZYqGe7VhTASUb3doXVk6WtjD0O4DTS+xBx2Zpr1vRvg==" crossorigin="anonymous" />
@endsection

@section('botones')

<a href="{{ route('recetas.index') }}" class="btn btn-primary mr-2 text-white">Volver</a>

@endsection

@section('content')

    <h2 class="text-center mb-2">Crear Nueva Receta</h2>

    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <form action="{{ route('recetas.store') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  novalidate>

                @csrf

                {{-- Titulo --}}
                <div class="form-group">
                    <label for="titulo">Titulo Receta</label>
                    <input type="text"
                           name="titulo"
                           class="form-control @error('titulo') is-invalid @enderror"
                           id="titulo"
                           placeholder="Titulo receta"
                           value="{{ old('titulo') }}">

                    @error('titulo')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Categoria --}}
                <div class="form-group">
                    <label for="categoria">Categoría</label>

                    <select name="categoria"
                            id="categoria"
                            class="form-control @error('categoria') is-invalid @enderror">

                        <option value="">-- Seleccione una opción --</option>
                        @foreach ($categorias as $categoria)
                             <option value="{{ $categoria->id }}"
                                     {{ old('categoria') == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>

                    @error('categoria')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                {{-- Preparacion --}}
                <div class="form-group">
                    <label for="preparacion">Preparación</label>
                    <input id="preparacion" type="hidden" name="preparacion" value="{{ old('preparacion') }}">

                    <trix-editor input="preparacion" class="form-control @error('preparacion') is-invalid @enderror"></trix-editor>

                    @error('preparacion')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Ingredientes --}}
                <div class="form-group">
                    <label for="ingredientes">Ingredientes</label>
                    <input id="ingredientes" type="hidden" name="ingredientes" value="{{ old('ingredientes') }}">

                    <trix-editor input="ingredientes" class="form-control @error('ingredientes') is-invalid @enderror"></trix-editor>

                    @error('ingredientes')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Imagen --}}
                <div class="form-group">
                    <label for="imagen">Elige una imagen</label>
                    <input id="imagen"
                           class="form-control @error('imagen') is-invalid @enderror"
                           name="imagen"
                           type="file">

                    @error('imagen')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Agregar Receta">
                </div>

            </form>
        </div>
    </div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.js" integrity="sha512-zEL66hBfEMpJUz7lHU3mGoOg12801oJbAfye4mqHxAbI0TTyTePOOb2GFBCsyrKI05UftK2yR5qqfSh+tDRr4Q==" crossorigin="anonymous" defer></script>
@endsection
