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
        // Obtener el usuario autenticado
        $user = Auth::user();

        // // Obtener todas las imágenes cargadas por el usuario autenticado
        // $imagenes = $user->imagenes()->orderBy('id', 'desc')->get();

        // // Debug: Imprimir el arreglo de imágenes
        // dd($imagenes);

        // Pasar las imágenes a la vista
        return view("home.index", compact("imagenes"));
    }
    public function create()
    {
        return view('imagenes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'imagen' => 'required|file|mimes:jpg,png,jpeg|max:1024',
        ]);

        // Obtenemos el archivo de la petición
        if($imagenFile = $request->file('imagen')){
            $folder = "imagenesguardadass3";
            $peso = $imagenFile->getSize();
            $extension = $imagenFile->extension();
            $ruta = Storage::disk("s3")->put($folder, $imagenFile, 'public');
            $imagenFile->archivo()->create([
                'imagen'=> $imagenFile,
                'extension'=> $extension,
                'peso'=> $peso,
                'local'=> false,

            ]);
        };

        return redirect()->route('home.index')->with('success', 'Imagen cargada exitosamente.');
    }
}
