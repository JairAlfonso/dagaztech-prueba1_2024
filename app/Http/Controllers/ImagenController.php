<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imagen;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ImagenController extends Controller
{
    public function index()
    {
        //metodo para ver todas la imagenes guardadas en la base de datos
        $imagenes = Imagen::all();
        return response()->json($imagenes);       

    }
    public function create()
    {
        return view('imagenes.create');
    }

    public function store(Request $request)
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        $request->validate([
            'nombre' => 'required|max:255|unique:imagenes',
            'imagen' => 'required|file|mimes:jpg,png,jpeg|max:1024',
        ], [
            'nombre.unique' => 'El nombre de la imagen ya está en uso. Por favor, elige otro.',
        ]);

        // Obtenemos el archivo de la petición
        if ($imagenFile = $request->file('imagen')) {

            $folder = "imagenesguardadass3";
            $ruta = Storage::disk("s3")->put($folder, $imagenFile, 'public');

            $user->imagenes()->create([
                'nombre' => $request->nombre,
                'imagen' => $ruta,
            ]);
        };

        return redirect()->route('home.index')->with('success', 'Imagen cargada exitosamente.');
    }
}
