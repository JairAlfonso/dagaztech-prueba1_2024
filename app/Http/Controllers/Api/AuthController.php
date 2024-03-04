<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([$user, 'menssage' => 'Usuario registrado!'], Response::HTTP_OK);
    }
    public function login(Request $request)
    {
        $credenciales = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!$token = auth()->attempt($credenciales)) {
            return response()->json([
                'success' => false,
                'message' => 'información incorrecta!',
            ], Response::HTTP_UNAUTHORIZED);
        }
        
        return response()->json(
            [
                'success' => true,
                'token' => $token,
                'user' => Auth::user(),
                'message' => 'Usuario autenticado!',
            ],
            Response::HTTP_OK
        );
    }
    public function logout(Request $request)
    {
        return response()->json([
            "Mensaje" => "Metodo logout OK",
        ]);
    }
}
