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

        // Obtener todas las imágenes cargadas por el usuario autenticado
        $imagenes = $user->imagenes()->orderBy('id', 'desc')->get();

        // Debug: Imprimir el arreglo de imágenes
        dd($imagenes);

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
            'imagen' => 'required|image|mimes:jpg,png,jpeg|max:1024',
        ]);

        // Obtenemos el archivo de la petición
        $imagenFile = $request->file('imagen');

        // Subimos la imagen al bucket de AWS S3
        try {
            $rutaImagen = Storage::disk('s3')->put($imagenFile, file_get_contents($imagenFile), 'public');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al cargar la imagen: ' . $e->getMessage());
        }

        // Guardamos la información de la imagen en la base de datos
        $imagen = new Imagen();
        $imagen->nombre = $request->nombre;
        $imagen->imagen = $rutaImagen; // Guardamos la ruta de la imagen en el bucket de S3
        $imagen->save();

        return redirect()->route('home.index')->with('success', 'Imagen cargada exitosamente.');
    }
}
