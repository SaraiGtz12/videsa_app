<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function IniciarSesion(Request $request){
        
        $request->validate([
            'UserEmailTxt' => 'required|email',
            'UserPasswordTxt' => 'required|string'
        ]);

        Log::info('Los datos llegaron'.$request);

        try{
            if($usuario = User::where('correo', $request->input('UserEmailTxt'))->first()){
                if($usuario->id_estatus == 1){
                    try{
                        if(Hash::check($request->input('UserPasswordTxt'), $usuario->contrasena)){
                            Auth::login($usuario);
                            $request->session()->regenerate();

                            if($usuario->id_rol == 3){
                                return to_route('Formualrio');
                            }else{
                                return to_route('Home');
                            }
                        }else{
                            return redirect()->back()->withErrors(['Error'=>"La contraseña no coincide"]);
                        }

                    }catch(Exception $e){
                        Log::error('Algo salio mal con la contraseña: '.$e->getMessage());
                        return redirect()->back()->withErrors(['Error'=>"La contraseña No coincide"]);
                    }
                }else{
                    return redirect()->back()->withErrors(['Inactivo'=>"¡Lo sentimos, tu cuenta ha sido desactivada!"]);
                }
            }else{
                Log::info('usuario No Encontrado');
                try{
                    if(User::count() === 0){

                        $item = new User();
                        $item->nombre_usuario = "fevntura";
                        $item->nombre = "Fredy Jair Ventura";
                        $item->correo = $request->UserEmailTxt;
                        $item->contrasena = Hash::make($request->UserPasswordTxt);
                        $item->id_rol = 1;
                        $item->es_firmante = 1;
                        $item->rfc ="testuser";
                        $item->id_estatus = 1;
                        $item->save();

                        if($item){
                            Auth::login($item);
                            $request->session()->regenerate();
                            return to_route('Home');
                        }
                    }else{
                        return redirect()->back()->withErrors(['Error'=>"El correo no ha sido registrado en la empresa"]);
                    }
                }catch(Exception $e){
                    Log::error('Algo salio mal al crear al usuario: '.$e->getMessage());
                    return redirect()->back()->withErrors(['Error'=>"No se pudo crear al primer usuario"]);
                }
            }
        }catch(Exception $e){
            Log::error('Algo salio mal al buscar al usuario: '.$e->getMessage());
        }
    }

    public function LogOut(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('login');
    }
}
