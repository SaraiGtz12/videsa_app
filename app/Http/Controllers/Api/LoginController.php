<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login_api(Request $request):JsonResponse{
        $request->validate([
            'correo' => 'required|email|exists:usuarios,correo',
            'pass' => 'required'
        ]);

        $usuario = User::where('correo', $request->correo)->first();

        if(!$usuario || Hash::check($request->input('UserPasswordTxt'), $usuario->contrasena)){
            throw ValidationException::withMessages([
                'email' => ['Las credenciales proporcionadas son incorrectas.'],
            ]);
        }

        $token = $usuario->createToken('auth-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Inicio de sesión exitoso',
            'data' => [
                'user' => [
                    'id' => $usuario->id_usuario,
                    'name' => $usuario->nombre,
                    'email' => $usuario->correo,
                ],
                'token' => $token,
            ]
        ]);
    }
}
