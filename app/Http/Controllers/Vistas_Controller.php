<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\datos_servicio;
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
         $total_registros_mes_actual = DB::table('datos_servicios')
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count();
        $total_servicios_activos = DB::table('datos_servicios')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->where('id_estatus', 5)
            ->count();
         $total_servicios_pendientes = DB::table('datos_servicios')
            ->where('id_estatus', 3)
            ->count();
       

        $detalles = datos_servicio::join('ordenes_servicios','datos_servicios.id_orden_servicio','=','ordenes_servicios.id_orden_servicio')
        ->join('normas', 'normas.id_norma', '=', 'datos_servicios.id_norma')
        ->join('usuarios', 'usuarios.id_usuario', '=', 'ordenes_servicios.muestreador_asignado')
        ->join('clientes', 'clientes.id_cliente', '=', 'ordenes_servicios.id_cliente')
        ->select('normas.nombre as nom', 'ordenes_servicios.*', 'datos_servicios.*', 'usuarios.nombre as muestreador', 'clientes.razon_social','datos_servicios.id_datos_servicio', 'datos_servicios.id_estatus as estatus' )
        ->orderBy('ordenes_servicios.created_at', 'desc') 
        ->get();
        return view('Dashboard.Home', compact('detalles','total_registros_mes_actual','total_servicios_activos','total_servicios_pendientes'));
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
        ->join('clientes as c','os.id_cliente','=','c.id_cliente')
        ->join('sucursales as s','c.id_cliente','=','s.id_cliente')
        ->select('os.numero_servicio', 
            'os.created_at as fecha_registro', 
            'n.nombre AS nombre_norma',
            'n.codigo AS codigo_norma',
            'ds.descripcion',
            'ds.id_datos_servicio',
            'c.razon_social',
            's.calle',
            's.numero',
            's.colonia',
            's.ciudad',
            's.estado',
            's.codigo_postal','os.responsable','os.cargo','os.telefono as tel')
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
