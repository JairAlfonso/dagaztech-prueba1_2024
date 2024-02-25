<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ImagenController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'show']);

Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'show']);

Route::post('/login', [LoginController::class, 'login']);


Route::get('/home', [HomeController::class, 'index']);

Route::get('/logout', [LogoutController::class, 'logout']);


// Route::get('/create', function () {
//     return view('imagenes.create');
// });

// Route::get('/imagenes/create', [ImagenController::class, 'create']);

Route::middleware(['auth'])->group(function () {
    // Rutas para mostrar el formulario de creación y procesar la creación de imágenes
    Route::get('/imagenes/create', [ImagenController::class, 'create'])->name('imagenes.create');
    Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');

    // Rutas para mostrar la lista de imágenes y otras operaciones relacionadas con ellas
    Route::get('/imagenes', [ImagenController::class, 'index'])->name('imagenes.index');
    Route::get('/imagenes/{imagen}', [ImagenController::class, 'show'])->name('imagenes.show');
    Route::get('/imagenes/{imagen}/edit', [ImagenController::class, 'edit'])->name('imagenes.edit');
    Route::put('/imagenes/{imagen}', [ImagenController::class, 'update'])->name('imagenes.update');
    Route::delete('/imagenes/{imagen}', [ImagenController::class, 'destroy'])->name('imagenes.destroy');
});

Route::get('/home', [HomeController::class, 'index'])->name('home.index');