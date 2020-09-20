<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Receta;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{


    public function show(Perfil $perfil)
    {
        $recetas = Receta::where('user_id', $perfil->user_id)->paginate(12);
        return view('perfiles.show', compact('perfil', 'recetas'));
    }


    public function edit(Perfil $perfil)
    {
        return view('perfiles.edit', compact('perfil'));
    }


    public function update(Request $request, Perfil $perfil)
    {
        // Validar
        $data = request()->validate([
            'nombre' => 'required',
            'url' => 'required',
            'biografia' => 'required',
        ]);

        // Asignar Nombre y Url
        auth()->user()->name = $data['nombre'];
        auth()->user()->url  = $data['url'];
        auth()->user()->save();

        // Eliminar url y nombre de data
        unset($data['nombre']);
        unset($data['url']);

        // Si sube una imagen
        if ($request['imagen']) {
            // Guardo en storage y obtengo la ruta
            $ruta_imagen = $request['imagen']->store('upload-perfiles', 'public');

            // Resize imagen
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(600, 600);
            $img->save();

            // Crear un arreglo de imagen
            $array_imagen = ['imagen' => $ruta_imagen];
        } else {

        }

        // Asignar Biografia e Imagen
        auth()->user()->perfil()->update(array_merge(
            $data,
            $array_imagen ?? []
        ));

        // Redireccionar
        return redirect()->action('RecetaController@index');
    }


    public function destroy(Perfil $perfil)
    {
        //
    }
}
