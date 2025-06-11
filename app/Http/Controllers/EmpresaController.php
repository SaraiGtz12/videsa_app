<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Sucursal;
use Carbon\Carbon;

class EmpresaController extends Controller
{
    //para empresas 
    public function create()
    {
        $clientes = Cliente::where('estatus', 1)->get();
        return view('Dashboard.AgregarEmpresa', compact('clientes')); 
    }

    public function store(Request $request)
    {
    
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
       public function desactivar($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->estatus = 0;
        $cliente->save();

        return response()->json(['success' => true, 'message' => 'cliente eliminado correctamente.']);
    }

    public function update(Request $request)
    {

        
        $request->validate([
            'id' => 'required|integer|exists:clientes,id',
            'razon_social' => 'required|string|max:255',
            'rfc' => 'required|string|max:20',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email',
        ]);


        $cliente = Cliente::find($request->id);
        $cliente->update([
            'razon_social' => $request->razon_social,
            'rfc' => $request->rfc,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'actualizado_en' => Carbon::now()
        ]);


        return redirect()->back()->with('success', 'Cliente actualizada correctamente.');
    }

//para sucursales
    public function obtenerSucursales($id)
    {
        $sucursales = Sucursal::where('id_cliente', $id)->get();
        return response()->json($sucursales);
    }



    public function guardarSucursal(Request $request)
    {
    
        $validated = $request->validate([
            'id_cliente' => 'required|string|max:255',
            'nombre' => 'required|string|max:20',
            'codigo' => 'required|string|max:20',
            'calle' => 'required|string|max:20',
            'numero' => 'required|string|max:20',
            'colonia' => 'required|string|max:20',
            'alcaldia' => 'required|string|max:20',
            'estado' => 'required|string|max:20',
            'cp' => 'required|string|max:20',
            'telefono' => 'required|string|max:20',
        ]);

        $cliente = Sucursal::create([
            'id_cliente' => $request->id_cliente,
            'nombre' => $request->nombre,
            'codigo' => $request->codigo,
            'calle' => $request->calle,
            'numero' => $request->numero,
            'colonia' => $request->colonia,
            'alcaldia' => $request->alcaldia,
            'estado' => $request->estado,
            'cp' => $request->cp,
            'telefono' => $request->telefono,
            'creado_en' => Carbon::now(),
            'actualizado_en' => null
        ]);

      

        return redirect()->route('empresa.create')->with('success', 'Sucursal registrada correctamente.');
    }
    

    public function updateSucursal(Request $request)
    {

        // dd('entre');die;
        $validated = $request->validate([
            'id' => 'required|integer|exists:sucursales,id',
            'id_cliente' => 'required|integer|exists:clientes,id',
            'nombre' => 'required|string|max:20',
            'codigo' => 'required|string|max:20',
            'calle' => 'required|string|max:20',
            'numero' => 'required|string|max:20',
            'colonia' => 'required|string|max:20',
            'ciudad' => 'required|string|max:20', 
            'estado' => 'required|string|max:20',
            'codigo_postal' => 'required|string|max:20', 
            'telefono' => 'required|string|max:20',
        ]);


        $sucursal = Sucursal::find($request->id);
        $sucursal->update([
            'id_cliente' => $request->id_cliente,
            'nombre' => $request->nombre,
            'codigo' => $request->codigo,
            'calle' => $request->calle,
            'numero' => $request->numero,
            'colonia' => $request->colonia,
            'ciudad' => $request->ciudad,
            'estado' => $request->estado,
            'codigo_postal' => $request->codigo_postal,
            'telefono' => $request->telefono,
            'actualizado_en' => Carbon::now()
        ]);


        return redirect()->back()->with('success', 'sucursal actualizada correctamente.');
    }



}
