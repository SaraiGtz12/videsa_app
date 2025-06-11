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



// public function guardarSucursal(Request $request)
// {
//    ;
//     $request->validate([
//         'id_cliente' => 'required|exists:clientes,id',
//         'telefono' => 'required|string|max:20',
//         'calle' => 'required|string',
//         'numero' => 'required',
//         'colonia' => 'required|string',
//         'alcaldia' => 'required|string',
//         'estado' => 'required|string',
//         'cp' => 'required|string',
//         'nombre' => 'required|string',
//     ]);

//     if ($request->filled('id_sucursal')) {
//         // Editar
//         $sucursal = Sucursal::findOrFail($request->id_sucursal);
//         $sucursal->update([
//             'id_cliente' => $request->id_cliente,
//             'nombre' => $request->nombre,
//             'codigo' => $request->codigo, 
//             'telefono' => $request->telefono,
//             'calle' => $request->calle,
//             'numero' => $request->numero,
//             'colonia' => $request->colonia,
//             'ciudad' => $request->alcaldia,
//             'estado' => $request->estado,
//             'codigo_postal' => $request->cp,
//             'actualizado_en' => Carbon::now(),
//         ]);
//         $mensaje = 'Sucursal actualizada correctamente.';
//     } else {
//         // Crear
//         Sucursal::create([
//             'id_cliente' => $request->id_cliente,
//             'nombre' => $request->nombre,
//             'codigo' => 'SUC-' . $request->id_cliente,
//             'telefono' => $request->telefono,
//             'calle' => $request->calle,
//             'numero' => $request->numero,
//             'colonia' => $request->colonia,
//             'ciudad' => $request->alcaldia,
//             'estado' => $request->estado,
//             'codigo_postal' => $request->cp,
//             'creado_en' => Carbon::now(),
//             'actualizado_en' => null,
//         ]);
//         $mensaje = 'Sucursal registrada correctamente.';
//     }

//     return response()->json(['message' => $mensaje]);
// }



  



    
    public function obtenerSucursales($id)
    {
        $sucursales = Sucursal::where('id_cliente', $id)->get();
        return response()->json($sucursales);
    }

     public function updateSucursal(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:sucursal,id',

            'nombre' => 'required|string',
            'codigo' => 'required|string|max:20',
            'calle' => 'required|string|max:20',
            'numero' => 'required|integer',
            'colonia' => 'required|email', 
            'alcaldia' => 'required|string',
            'estado' => 'required|string',
            'cp' => 'required|string',
            'telefono' => 'required|string',
        ]);

        $sucursal = Sucursal::find($request->id);
        $sucursal->update([
            'nombre' => $request->nombre,
            'codigo' => $request->codigo,
            'calle' => $request->calle,
            'numero' => $request->numero,
            'colonia' => $request->colonia,
            'ciudad' => $request->alcaldia,
            'estado' => $request->estado,
            'codigo_postal' => $request->cp,
            'telefono' => $request->telefono,
            'actualizado_en' => Carbon::now(),
        ]);


        return redirect()->back()->with('success', 'Sucursal actualizada correctamente.');
    }



  

}
