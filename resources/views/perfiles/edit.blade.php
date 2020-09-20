@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.min.css" integrity="sha512-sC2S9lQxuqpjeJeom8VeDu/jUJrVfJM7pJJVuH9bqrZZYqGe7VhTASUb3doXVk6WtjD0O4DTS+xBx2Zpr1vRvg==" crossorigin="anonymous" />
@endsection

@section('botones')
    <a href="{{ route('recetas.index') }}" class="btn btn-primary mr-2 text-white">Volver</a>
@endsection

@section('content')

    <h1 class="text-center">Editar mi perfil</h1>

    <div class="row justify-content-center mt-2">
        <div class="col-md-10 bg-white p-3">
           <form action="{{ route('perfils.update', ['perfil' => $perfil->id]) }}"
                 method="POST"
                 enctype="multipart/form-data"
           >

                @csrf

                @method('PUT')

                {{-- Nombre --}}
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text"
                           name="nombre"
                           class="form-control @error('nombre') is-invalid @enderror"
                           id="nombre"
                           placeholder="Tu Nombre"
                           value="{!! $perfil->usuario->name !!}">

                    @error('nombre')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Sitio Web --}}
                <div class="form-group">
                    <label for="nombre">Sitio Web</label>
                    <input type="text"
                           name="url"
                           class="form-control @error('url') is-invalid @enderror"
                           id="url"
                           placeholder="Tu Sitio Web"
                           value="{!! $perfil->usuario->url !!}">

                    @error('url')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Biografia --}}
                <div class="form-group">
                    <label for="biografia">Biografia</label>
                    <input id="biografia" type="hidden" name="biografia" value="{{ $perfil->biografia }}">

                    <trix-editor input="biografia" class="form-control @error('biografia') is-invalid @enderror"></trix-editor>

                    @error('biografia')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Imagen --}}
                <div class="form-group">
                    <label for="imagen">Tu imagen</label>
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

                @if ($perfil->imagen)
                    <div class="mt-2 mb-4">
                        <p>Imagen actual</p>
                        <img src="/storage/{{ $perfil->imagen }}" style="width: 300px">
                    </div>
                @endif

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Guardar">
                </div>

            </form>
        </div>
    </div>

@endsection


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.js" integrity="sha512-zEL66hBfEMpJUz7lHU3mGoOg12801oJbAfye4mqHxAbI0TTyTePOOb2GFBCsyrKI05UftK2yR5qqfSh+tDRr4Q==" crossorigin="anonymous" defer></script>
@endsection
