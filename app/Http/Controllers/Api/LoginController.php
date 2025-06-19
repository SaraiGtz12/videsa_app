<?php

namespace App\Http\Controllers\Api; // Mantenemos el mismo namespace

use App\Http\Controllers\Controller;
use App\Models\User; // Asegúrate de que este modelo User existe y apunta a tu tabla de usuarios
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function IniciarSesion(Request $request) 
    {
        // 1. Validación de los datos de entrada
        // Campos 'email' y 'password' esperados del frontend React  Native.
       try{
         $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);
       }catch(Exception $e){
        Log::error($e->getMessage());
       }

        // Registrar los datos recibidos para depuración (opcional, pero útil)
        Log::info('Intento de login para email: ' . $request->input('email'));

        try {
            // 2. Buscar al usuario por el correo
            // Asegúrate de que 'correo' sea la columna en tu tabla de usuarios
            $usuario = User::where('correo', $request->input('email'))->first();
            Log::info('Datos: '.$usuario);
            // Si el usuario no existe
            if (!$usuario) {
                Log::warning('Intento de login con correo no registrado: ' . $request->input('email'));
                return response()->json([
                    'message' => 'El usuario no existe'
                ], 401); 
            }

            // 3. Verificar el estatus del usuario
            if ($usuario->id_estatus != 1) { 
                Log::warning('Intento de login con cuenta inactiva: ' . $usuario->correo);
                return response()->json([
                    'message' => '¡Lo sentimos, tu cuenta ha sido desactivada! Contacta a soporte.'
                ], 403); 
            }

            // 4. Verificar la contraseña
            if (!Hash::check($request->input('password'), $usuario->contrasena)) {
                Log::warning('Intento de login con contraseña incorrecta para: ' . $usuario->correo);
                return response()->json([
                    'message' => 'Credenciales incorrectas. Verifica tu correo y contraseña.'
                ], 401); 
            }

            // 5. Verificar el rol del usuario
            if($usuario -> id_rol != 3){
                Log::warning('Intento de login en cuenta con un rol sin permisos' . $usuario->correo);
                return response()-> json([
                    'message' => '¡Lo sentimos su cuenta no tiene los permisos necesarios! Contacte a soporte'
                ]);
            }

            // Autenticación exitosa.
            $token = $usuario->createToken('auth-token')->plainTextToken;
            Log::info('Login exitoso para: ' . $usuario->correo);

            // Retorna una respuesta JSON de éxito con los datos del usuario y el token
            return response()->json([
                'message' => 'Inicio de sesión exitoso',
                'user' => [ 
                    'id' => $usuario->id_usuario,
                    'nombre' => $usuario->nombre,
                    'email' => $usuario->correo,
                    'rol_id' => $usuario->id_rol,
                    
                ],
                'token' => $token, // El token es esencial para futuras solicitudes autenticadas
            ], 200); // 200 OK

        } catch (Exception $e) {
            // Captura cualquier error inesperado
            Log::error('Error inesperado en IniciarSesion del LoginController: ' . $e->getMessage());
            return response()->json([
                'message' => 'Ocurrió un error inesperado en el servidor. Por favor, intenta de nuevo.',
                'error_details' => $e->getMessage() // Detalles del error solo para depuración, no en producción
            ], 500); // 500 Internal Server Error
        }
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function LogOut(Request $request) // Mantener el nombre del método
    {
        // Verifica si hay un usuario autenticado y revoca su token actual.
        if ($request->user()) {
            $request->user()->currentAccessToken()->delete();
            Log::info('Cierre de sesión exitoso para usuario ID: ' . $request->user()->id_usuario);
        } else {
            Log::warning('Intento de cierre de sesión sin usuario autenticado.');
        }
        
        return response()->json(['message' => 'Sesión cerrada exitosamente.']);
    }
}
