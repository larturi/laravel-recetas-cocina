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
        $this->middleware('auth', ['except' => ['show', 'search']]);
    }

    public function index()
    {

        $usuario = Auth::user();

        $recetas = Receta::where('user_id', $usuario->id)->paginate(10);

        return view('recetas.index')
            ->with('recetas', $recetas)
            ->with('usuario', $usuario);
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
        $img = Image::make(base_path() . "/storage/app/public/" . $ruta_imagen)->fit(1000, 550);
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
        // Obtener si al usuario actual le gusta la receta
        $like = (auth()->user()) ? auth()->user()->meGusta->contains($receta->id) : false;

        // Pasa la cantidad de likes a la vista
        $likes = $receta->likes->count();

        return view('recetas.show', compact('receta', 'like', 'likes'));
    }

    public function edit(Receta $receta)
    {
        // Revisar el Policy
        $this->authorize('view', $receta);

        $categorias = CategoriaReceta::all(['id', 'nombre']);

        return view('recetas.edit')
             ->with('categorias', $categorias)
             ->with('receta', $receta);
    }

    public function update(Request $request, Receta $receta)
    {
        // Revisar el Policy
        $this->authorize('update', $receta);

        // Validacion formulario
        $data = $request->validate([
            'titulo'       => 'required|min:3',
            'categoria'    => 'required',
            'preparacion'  => 'required',
            'ingredientes' => 'required',
        ]);

        $receta->titulo = $data['titulo'];
        $receta->preparacion = $data['preparacion'];
        $receta->ingredientes = $data['ingredientes'];
        $receta->categoria_id = $data['categoria'];

        // Si el usuario cambia la imagen
        if($request->imagen) {
            // Guardo en storage y obtengo la ruta
            $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');

            // Resize imagen
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
            $img->save();

            $receta->imagen = $ruta_imagen;
        }

        $receta->save();

        return redirect()->action('RecetaController@index');
    }

    public function destroy(Receta $receta)
    {
         // Revisar el Policy
         $this->authorize('delete', $receta);

         $receta->delete();

        return redirect()->action('RecetaController@index');
    }

    public function search(Request $request)
    {
        $busqueda = $request['buscar'];

        $recetas = Receta::where('titulo', 'like', '%' . $busqueda . '%')->paginate(12);
        $recetas->append(['buscar' => $busqueda]);

        return view('busquedas.show', compact('recetas', 'busqueda'));
    }

}
