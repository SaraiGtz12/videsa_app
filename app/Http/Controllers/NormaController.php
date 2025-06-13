<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Norma;
use Illuminate\Support\Facades\Log;


class NormaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000',
        ]);

        Norma::create([
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'id_estatus' => 1,
        ]);

        return redirect()->back()->with('success', 'Norma registrada exitosamente.');
    }
    public function desactivar($id)
    {
        Log::info("Desactivando norma con ID: $id");
          
        $norma = Norma::findOrFail($id);
        $norma->id_estatus = 2;
        $norma->save();

        return response()->json(['success' => true, 'message' => 'Norma desactivada correctamente.']);
    }
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:normas,id_norma',
        
        ]);

        $norma = Norma::find($request->id);
        $norma->update([
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->back()->with('success', 'Norma actualizada correctamente.');
    }

    


}
