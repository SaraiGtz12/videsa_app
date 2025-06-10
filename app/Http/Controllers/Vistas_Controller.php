<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;

class Vistas_Controller extends Controller
{   
    public function Login(){
        return view('index');
    }

    public function Home(){
        if (!$usuario = Auth::user()) {
            // Redirige a otra página (por ejemplo, la página de inicio)
            return redirect()->route('login')->withErrors(['error' => 'No tienes permiso para acceder a esta página.', 'Titulo'=>'Acceso Denegado']);
        }
        return view('Dashboard.Home');
    }

    public function RegistrarCliente(){
        if (!$usuario = Auth::user()) {
            // Redirige a otra página (por ejemplo, la página de inicio)
            return redirect()->route('login')->withErrors(['error' => 'No tienes permiso para acceder a esta página.', 'Titulo'=>'Acceso Denegado']);
        }
        return view('Dashboard.RegistrarCliente');
    }

    public function RegistrarServicio(){
        if (!$usuario = Auth::user()) {
            // Redirige a otra página (por ejemplo, la página de inicio)
            return redirect()->route('login')->withErrors(['error' => 'No tienes permiso para acceder a esta página.', 'Titulo'=>'Acceso Denegado']);
        }
        $clientes = Cliente::all();
        return view('Dashboard.AgregarServicio', compact('clientes'));
    }

    public function Buscar(){
        if (!$usuario = Auth::user()) {
            // Redirige a otra página (por ejemplo, la página de inicio)
            return redirect()->route('login')->withErrors(['error' => 'No tienes permiso para acceder a esta página.', 'Titulo'=>'Acceso Denegado']);
        }
        return view('Dashboard.Buscar');
    }
    
    public function VistaServiciosRegistrados(){
        if (!$usuario = Auth::user()) {
            // Redirige a otra página (por ejemplo, la página de inicio)
            return redirect()->route('login')->withErrors(['error' => 'No tienes permiso para acceder a esta página.', 'Titulo'=>'Acceso Denegado']);
        }
        return view('Dashboard.ServiciosRegistrados');
    }

    public function VistaServiciosCompletados(){
        if (!$usuario = Auth::user()) {
            // Redirige a otra página (por ejemplo, la página de inicio)
            return redirect()->route('login')->withErrors(['error' => 'No tienes permiso para acceder a esta página.', 'Titulo'=>'Acceso Denegado']);
        }
        return view('Dashboard.ServiciosCompletados');
    }

    public function VistaAgregarUsuarios(){
        if (!$usuario = Auth::user()) {
            // Redirige a otra página (por ejemplo, la página de inicio)
            return redirect()->route('login')->withErrors(['error' => 'No tienes permiso para acceder a esta página.', 'Titulo'=>'Acceso Denegado']);
        }
        $roles = Rol::all();
        return view('Dashboard.AgregarUsuarios', compact('roles'));
    }
    public function VistaFormulario(){
        if (!$usuario = Auth::user()) {
            // Redirige a otra página (por ejemplo, la página de inicio)
            return redirect()->route('login')->withErrors(['error' => 'No tienes permiso para acceder a esta página.', 'Titulo'=>'Acceso Denegado']);
        }
        $clientes = Cliente::all();
        return view('Dashboard.Formulario', compact('clientes'));
    }
    public function AgregarEmpresa(){
        if (!$usuario = Auth::user()) {
            // Redirige a otra página (por ejemplo, la página de inicio)
            return redirect()->route('login')->withErrors(['error' => 'No tienes permiso para acceder a esta página.', 'Titulo'=>'Acceso Denegado']);
        }
        return view('Dashboard.AgregarEmpresa');
    }
    public function AgregarNorma(){

        // Verifica si el tipo de usuario no es el que esperas (por ejemplo, si el tipo_usuario_id no es igual a 1, O si no hay un tipo de usuario)
        if (!$usuario = Auth::user()) {
            // Redirige a otra página (por ejemplo, la página de inicio)
            return redirect()->route('login')->withErrors(['error' => 'No tienes permiso para acceder a esta página.', 'Titulo'=>'Acceso Denegado']);
        }
        return view('Dashboard.AgregarNorma');
    }
}
