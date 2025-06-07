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
            "apellidoPP" => "required|string",
            "apellidoMP" => "required|string",
            "rolP" => "required|integer",
            "UsuarioP" => "required|email|unique:users,emailUser",
            "ContrasenaP" => "required|string",
        ]);

        try{
            $usuario = new User();
            $usuario->emailuser = $request->UsuarioP;
            $usuario->password = Hash::make($request->ContrasenaP);
            $usuario->rolId = $request->rolP;
            $usuario->save();

            $usuario_id = $usuario->idUser;

            $persona = new Person();
            $persona->name = $request->nombreP;
            $persona->lastName = $request->apellidoPP;
            $persona->secondLastName = $request->apellidoMP;
            $persona->userId = $usuario_id;
            $persona->save();

            return redirect()->back()->with(['success' => '¡El usuario se ha registrado con éxito!']);
        }catch(Exception $e){
            Log::error('Error al registrar: '.$e->getMessage());
            return redirect()->back()->withErrors(['error' => '¡El usuario se no fue registrado!']);
        }
    }
}
