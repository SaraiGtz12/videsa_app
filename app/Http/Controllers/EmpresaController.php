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
        $clientes = Cliente::all();
        return view('Dashboard.AgregarEmpresa', compact('clientes')); 
    }

    public function store(Request $request)
    {
        // Validar datos
        $validated = $request->validate([
            'razon_social' => 'required|string|max:255',
            'rfc' => 'required|string|max:20',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email',
        ]);

        $cliente = Cliente::create([
            'razon_social' => $request->razon_social,
            'rfc' => $request->rfc,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'creado_en' => Carbon::now(),
            'actualizado_en' => null,
        ]);

      

        return redirect()->route('empresa.create')->with('success', 'Empresa registrada correctamente.');
    }

    
    public function guardarSucursal(Request $request)
    {
        // Validar datos
        $validated = $request->validate([
            'id_cliente' => 'required|exists:clientes,id',
            'rfc' => 'required|string|max:20',
            'telefono' => 'required|string|max:20',
            'calle' => 'required|string',
            'numero' => 'required|integer',
            'colonia' => 'required|string',
            'alcaldia' => 'required|string',
            'estado' => 'required|string',
            'cp' => 'required|string',
            'nombre' => 'required|string',
        ]);

        $cliente = Cliente::findOrFail($request->id_cliente);

        Sucursal::create([
            'id_cliente' => $cliente->id,
            'nombre' => $request->nombre,
            'codigo' => 'SUC-' . $cliente->id,
            'telefono' => $request->telefono,
            'calle' => $request->calle,
            'numero' => $request->numero, 
            'colonia' => $request->colonia,
            'ciudad' => $request->alcaldia,
            'estado' => $request->estado,
            'codigo_postal' => $request->cp,
            'creado_en' => Carbon::now(),
            'actualizado_en' => Carbon::now(),
        ]);

        return redirect()->route('empresa.create')->with('success', 'Sucursal registrada correctamente.');
    }



     public function desactivar($id)
    {
        $norma = Cliente::findOrFail($id);
        $norma->activa = 0;
        $norma->save();

        return response()->json(['success' => true, 'message' => 'Norma desactivada correctamente.']);
    }
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:normas,id',

            'razon_social' => 'required|string|max:255',
            'rfc' => 'required|string|max:20',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email',
            
        
        ]);

        $norma = Cliente::find($request->id);
        $norma->update([
            'razon_social' => $request->razon_social,
            'rfc' => $request->rfc,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'actualizado_en' => Carbon::now()
        ]);


        return redirect()->back()->with('success', 'Norma actualizada correctamente.');
    }

  

}
