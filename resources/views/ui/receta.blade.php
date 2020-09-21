<div class="col-md-4 mt-4">
    <div class="card shadow">
        <img src="/storage/{{ $receta->imagen }}" class="card-img-top">

        <div class="card-body d-flex flex-column">
            <h3>{{ $receta->titulo }}</h3>

            <div class="meta-receta d-flex justify-content-between">
                @php
                   $fecha = $receta->created_at;
                @endphp

                <p class="text-primary fecha">
                    <fecha-receta fecha="{{ $fecha }}"></fecha-receta>
                </p>

                <p>
                    {{  count($receta->likes) . ' likes' }}
                </p>

            </div>

            <div class="card-text mb-3">
                {{ Str::words(strip_tags($receta->preparacion), 20) }}
            </div>

            <a class="btn btn-primary mt-auto d-block text-uppercase" href="{{ route('recetas.show', ['receta' => $receta->id]) }}">Ver receta</a>

        </div>


    </div>
</div>
