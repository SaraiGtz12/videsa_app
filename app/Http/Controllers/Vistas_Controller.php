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
use App\Models\orden_servicio;
use App\Models\OrdenTrabajo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $detalles = orden_servicio::join('datos_servicios','datos_servicios.id_orden_servicio','=','ordenes_servicios.id_orden_servicio')
        ->join('normas', 'normas.id_norma', '=', 'datos_servicios.id_norma')
        ->select('normas.nombre as nom', 'ordenes_servicios.*', 'datos_servicios.*')
        ->get();
        return view('Dashboard.Home', compact('detalles'));
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
        $ordenes = DB::table('ordenes_servicios as os')
        ->join('datos_servicios as ds', 'os.id_orden_servicio', '=', 'ds.id_orden_servicio')
        ->join('normas as n', 'ds.id_norma', '=', 'n.id_norma')
        ->select('os.numero_servicio', 
            'os.created_at as fecha_registro', 
            'n.nombre AS nombre_norma',
            'ds.descripcion',
            'ds.id_datos_servicio')
        ->where('os.muestreador_asignado', $usuario->id_usuario)
        ->get();

        return view('Dashboard.Formulario', compact('ordenes','clientes'));
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
