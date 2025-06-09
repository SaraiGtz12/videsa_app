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
        try{
            $request->validate([
                "nombreP" => "required|string",
                "apellidos" => "required|string",
                "rolP" => "required|integer",
                "rfcUsuario" => "required|string|unique:usuarios,rfc",
                "UsuarioP" => "required|email|unique:usuarios,correo",
                "ContrasenaP" => "required|string",
            ]);
        }catch(Exception $e){
            Log::error('Error en la validación: '.$e->getMessage());
        }

        try{
            // Procesamiento
            $primer_nombre = explode(' ', trim($request->nombreP))[0];
            $primer_letra_nombre = substr($primer_nombre, 0, 1); 
            $primer_apellido = explode(' ', trim($request->apellidos))[0];
            $username =$primer_letra_nombre.''.$primer_apellido;
            $username = strtolower($username);

            $responsable = 0;

            if($request->rolP == 1 || $request->rolP == 2){
                $responsable = 1;
            }

            $usuario = new User();
            $usuario->correo = $request->UsuarioP;
            $usuario->nombre_usuario = $username;
            $usuario->nombre = $request->nombreP.' '.$request->apellidos;
            $usuario->contrasena = Hash::make($request->ContrasenaP);
            $usuario->id_rol = $request->rolP;
            $usuario->es_firmante = $responsable;
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
