<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request){

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

        return response($user, Response::HTTP_OK); 
    }
    public function login(Request $request){

       $credenciales = $request->validate([
            'email'=> ['required', 'email'],
            'password'=> ['required'],
        ]);

        if(Auth::attempt($credenciales)){
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;
            $cookie = cookie('cookie_token', $token, 60*24);
            return response(["token"=>$token], Response::HTTP_OK)->withoutCookie(($cookie));
        }else{
            return response(Response::HTTP_UNAUTHORIZED);
        }
    }
    public function logout(){
        return response()->json([
            "Mensaje" => "Metodo logout OK",
        ]);
    }

}
