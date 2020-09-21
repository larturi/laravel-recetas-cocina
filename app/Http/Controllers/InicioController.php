<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CategoriaReceta;

class InicioController extends Controller
{
    public function index()
    {
        // Mostrar las recetas por cantidad de votos
        // $votadas = Receta::has('likes', '>', 1)->get();
        $votadas = Receta::withCount('likes')->orderBy('likes_count', 'DESC')->take(3)->get();

        // Obtener las ultimas recetas
        $nuevas = Receta::latest()->take(12)->get();

        // Obtener las categorias
        $categorias = CategoriaReceta::all();

        // Recetas por categoria
        $recetas = [];

        foreach ($categorias as $categoria) {
            $recetas[Str::slug($categoria->nombre)][] = Receta::where('categoria_id', $categoria->id)->take(3)->get();
        }

        return view('inicio.index', compact('nuevas', 'recetas', 'votadas'));
    }
}
