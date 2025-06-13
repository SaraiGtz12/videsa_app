<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Sucursal;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class EmpresaController extends Controller
{
    //para empresas 
    public function create()
    {
        $clientes = Cliente::where('id_estatus', 1)->get();
        return view('Dashboard.AgregarEmpresa', compact('clientes')); 
    }

    public function store(Request $request)
    {
    
        $validated = $request->validate([
            'razon_social' => 'required|string|max:255|unique:clientes,razon_social',
            'rfc' => 'required|string|max:20',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email',
        ]);

        $cliente = Cliente::create([
            'razon_social' => $request->razon_social,
            'rfc' => $request->rfc,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'id_estatus' => 1,
        ]);
        return redirect()->route('empresa.create')->with('success', 'Empresa registrada correctamente.');
    }
    public function desactivar($id)
    {
        Log::info("Desactivando cliente con ID: $id");
        $cliente = Cliente::findOrFail($id);
        $cliente->id_estatus = 2;
        $cliente->save();

        return response()->json(['success' => true, 'message' => 'cliente eliminado correctamente.']);
    }

    public function update(Request $request)
    {

        Log::info('Actualizando cliente con ID: '.$request->id);
        $request->validate([
            'id_cliente' => 'required|integer|exists:clientes,id_cliente',
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
            'correo' => $request->correo
        ]);


        return redirect()->back()->with('success', 'Cliente actualizada correctamente.');
    }

//para sucursales
    public function obtenerSucursales($id)
    {
         Log::info('Llegue');
        $sucursales = Sucursal::where('id_cliente', $id)->get();
        return response()->json($sucursales);
    }



    public function guardarSucursal(Request $request)
    {
    
        Log::info('Los datos llegaron');

        
         $request->validate([
                'id_cliente' => 'required|integer',
                'nombre' => 'required|string|max:20',
                'codigo' => 'required|string|max:20',
                'calle' => 'required|string|max:20',
                'numero' => 'required|string|max:20',
                'colonia' => 'required|string|max:20',
                'ciudad' => 'required|string|max:20',
                'estado' => 'required|string|max:20',
                'codigo_postal' => 'required|string|max:20',
                'telefono' => 'required|string|max:20'
            ]);
        try{
            Log::info('se va a ingresar datos');
            $cliente = Sucursal::create([
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
                'id_estatus' => 1,
            ]);
        }catch(Exception $e){
            Log::error('Ocurrio algo:'.$e->getMessage());
        }


        return redirect()->route('empresa.create')->with('success', 'Sucursal registrada correctamente.');
    }
    

    public function updateSucursal(Request $request)
    {

        // dd('entre');die;
         Log::info('$request->id_sucursal: '.$request);
        try {
           $validated = $request->validate([
            'id_sucursal' => 'required|integer|exists:sucursales,id_sucursal',
                'id_cliente' => 'required|integer',
                    'nombre' => 'required|string|max:20',
                    'codigo' => 'required|string|max:20',
                    'calle' => 'required|string|max:20',
                    'numero' => 'required|string|max:20',
                    'colonia' => 'required|string|max:20',
                    'ciudad' => 'required|string|max:20',
                    'estado' => 'required|string|max:20',
                    'codigo_postal' => 'required|string|max:20',
                    'telefono' => 'required|string|max:20'
            ]);

           
            $sucursal = Sucursal::find($request->id_sucursal);
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
            ]);
        } catch (Exception $e) {
            Log::error('Error en la validación de sucursal: '.$e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error en la validación de sucursal.']);
        }


        return redirect()->back()->with('success', 'sucursal actualizada correctamente.');
    }



}
