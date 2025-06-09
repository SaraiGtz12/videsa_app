<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Person;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    public function RegistrarUsuarios(Request $request){
        Log::info("Función Cargada");
        $request->validate([
            "nombreP" => "required|string",
            "apellidos" => "required|string",
            "rolP" => "required|integer",
            "rfcUsuario" => "required|string|unique:users,rfc",
            "UsuarioP" => "required|email|unique:users,correo",
            "ContrasenaP" => "required|string",
        ]);

        try{
            $usuario = new User();
            $usuario->correo = $request->UsuarioP;
            $usuario->contrasena = Hash::make($request->ContrasenaP);
            $usuario->id_rol = $request->rolP;
            $usuario->es_firmante = 0;
            $usuario->rfc = $request->rfcUsuario;
            $usuario->activo = 1;
            $usuario->save();

            return redirect()->back()->with(['success' => '¡El usuario se ha registrado con éxito!']);
        }catch(Exception $e){
            Log::error('Error al registrar: '.$e->getMessage());
            return redirect()->back()->withErrors(['error' => '¡El usuario se no fue registrado!']);
        }
    }
}
