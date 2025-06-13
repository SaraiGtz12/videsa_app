<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\detalles_medicion_nom085;
use App\Models\Sucursal;
use App\Models\Norma;
use App\Models\OrdenTrabajo;
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
            $normas = Norma::select('id_norma', 'codigo')->where('id_estatus', 1)->get();
            $clientes = Cliente::select('id_cliente','razon_social')->get();
            $muestreadores = User::where('id_rol', 3)->get();

            return view('Dashboard.AgregarServicio', compact('clientes','normas', 'muestreadores'));
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
        $clientes = Cliente::where('id_estatus', 1)->get();

        return view('Dashboard.AgregarEmpresa', compact('clientes'));
    }
    public function AgregarNorma(){
        if (!$usuario = Auth::user()) {
                // Redirige a otra página (por ejemplo, la página de inicio)
                return redirect()->route('login')->withErrors(['error' => 'No tienes permiso para acceder a esta página.', 'Titulo'=>'Acceso Denegado']);
            }
        $normas = Norma::where('id_estatus', 1)->get();
        
        return view('Dashboard.AgregarNorma', compact('normas'));
    }
}
