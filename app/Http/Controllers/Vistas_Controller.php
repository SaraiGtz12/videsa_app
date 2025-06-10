<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Norma;


class Vistas_Controller extends Controller
{
    public function Login(){
        return view('index');
    }

    public function Home(){
        return view('Dashboard.Home');
    }

    public function RegistrarCliente(){
        return view('Dashboard.RegistrarCliente');
    }

    public function RegistrarServicio(){
          $clientes = Cliente::all();
          $normas = Norma::select('id', 'codigo')->where('activa', 1)->get();
        return view('Dashboard.AgregarServicio', compact('clientes','normas'));
    }

    public function Buscar(){
        return view('Dashboard.Buscar');
    }
    
    public function VistaServiciosRegistrados(){
        return view('Dashboard.ServiciosRegistrados');
    }

    public function VistaServiciosCompletados(){
        return view('Dashboard.ServiciosCompletados');
    }

    public function VistaAgregarUsuarios(){
        $roles = Rol::all();
        return view('Dashboard.AgregarUsuarios', compact('roles'));
    }
    public function VistaFormulario(){
         $clientes = Cliente::all();
        return view('Dashboard.Formulario', compact('clientes'));
    }
    public function AgregarEmpresa(){
        return view('Dashboard.AgregarEmpresa');
    }
     public function AgregarNorma(){
          $normas = Norma::where('activa', 1)->get();
          
          return view('Dashboard.AgregarNorma', compact('normas'));
    }
}
