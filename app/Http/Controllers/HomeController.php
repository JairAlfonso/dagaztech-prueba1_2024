<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imagen;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Obtener el ID del usuario autenticado
        $userId = Auth::id();

        // Obtener todas las imágenes desde la base de datos
        $imagenes = Imagen::where('user_id', $userId)->get();

        // Pasar las imágenes a la vista
        return view('home.index', compact('imagenes'));
    }
}
