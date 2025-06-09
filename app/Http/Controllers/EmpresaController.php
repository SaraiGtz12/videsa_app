<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Sucursal;
use Carbon\Carbon;

class EmpresaController extends Controller
{
    public function create()
    {
        return view('Dashboard.AgregarEmpresa'); 
    }

    public function store(Request $request)
    {
        // Validar datos
        $validated = $request->validate([
            'razon_social' => 'required|string|max:255',
            'rfc' => 'required|string|max:20',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email',
            'calle' => 'required|string',
            'colonia' => 'required|string',
            'alcaldia' => 'required|string',
            'estado' => 'required|string',
            'cp' => 'required|string',
        ]);

        $cliente = Cliente::create([
            'razon_social' => $request->razon_social,
            'rfc' => $request->rfc,
            'teléfono' => $request->telefono,
            'correo' => $request->correo,
            'creado_en' => Carbon::now(),
            'actualizado_en' => Carbon::now(),
        ]);

        Sucursal::create([
            'id_cliente' => $cliente->id,
            'nombre' => $request->razon_social,
            'código' => 'SUC-' . $cliente->id,
            'teléfono' => $request->telefono,
            'calle' => $request->calle,
            'numero' => '', 
            'colonia' => $request->colonia,
            'ciudad' => $request->alcaldia,
            'estado' => $request->estado,
            'codigo_postal' => $request->cp,
            'creado_en' => Carbon::now(),
            'actualizado_' => Carbon::now(),
        ]);

        return redirect()->route('empresa.create')->with('success', 'Empresa registrada correctamente.');
    }
}
