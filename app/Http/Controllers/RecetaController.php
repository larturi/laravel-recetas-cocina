<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Http\Request;
use App\Models\CategoriaReceta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    public function index()
    {
        $recetas = Auth::user()->recetas;

        return view('recetas.index')->with('recetas', $recetas);
    }


    public function create()
    {
        $categorias = CategoriaReceta::all(['id', 'nombre']);

        return view('recetas.create')
             ->with('categorias', $categorias);
    }


    public function store(Request $request)
    {
        // Validacion formulario
        $data = $request->validate([
            'titulo'       => 'required|min:3',
            'categoria'    => 'required',
            'preparacion'  => 'required',
            'ingredientes' => 'required',
            'imagen'       => 'required|image',
        ]);

        // Guardo en storage y obtengo la ruta
        $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');

        // Resize imagen
        $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
        $img->save();

        // Insert en BD con Model
        auth()->user()->recetas()->create([
            'titulo'       => $data['titulo'],
            'preparacion'  => $data['preparacion'],
            'ingredientes' => $data['ingredientes'],
            'imagen'       => $ruta_imagen,
            'categoria_id' => $data['categoria'],
            'created_at'   => date('Y-m-d H:i:s'),
            'updated_at'   => date('Y-m-d H:i:s'),
        ]);

        return redirect()->action('RecetaController@index');
    }

    public function show(Receta $receta)
    {
        return view('recetas.show')
            ->with('receta', $receta);
    }


    public function edit(Receta $receta)
    {
        //
    }


    public function update(Request $request, Receta $receta)
    {
        //
    }


    public function destroy(Receta $receta)
    {
        //
    }
}
