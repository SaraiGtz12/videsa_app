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
        Log::info("Los datos llegaron 2");
        
        $request->validate([
            'UserEmailTxt' => 'required|email',
            'UserPasswordTxt' => 'required|string'
        ]);

        Log::info('Validacion Hecha');

        if($usuario = User::where('emailUser', $request->input('UserEmailTxt'))->first()){
            Log::info('usuario Encontrado');
            Log::info($usuario);
            try{
                Log::info("correo");
                if(Hash::check($request->input('UserPasswordTxt'), $usuario->password)){
                    Log::info('Contraseña validada');
                    Auth::login($usuario);
                    $request->session()->regenerate();

                    if($usuario->rolId == 1){
                        return to_route('Home');
                    }else{
                        Log::info('Error en rol Id');
                    }
                }else{
                    return redirect()->back()->withErrors(['Error'=>"La contraseña no coincide"]);
                }

            }catch(Exception $e){
                Log::error('Algo salio mal con la contraseña: '.$e->getMessage());
                return redirect()->back()->withErrors(['Error'=>"La contraseña No coincide"]);
            }
        }else{
            Log::info('usuario No Encontrado');
            try{
                if(User::count() === 0){

                    Log::info('Tabla Vacia');

                    $item = new User();
                    $item->emailUser = $request->UserEmailTxt;
                    $item->password = Hash::make($request->UserPasswordTxt);
                    $item->rolId = 1;
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
    }

    public function LogOut(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('login');
    }
}
