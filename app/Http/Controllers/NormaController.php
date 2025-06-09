<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Norma;

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
            'activa' => 1,
        ]);

        return redirect()->back()->with('success', 'Norma registrada exitosamente.');
    }
    public function desactivar($id)
    {
        $norma = Norma::findOrFail($id);
        $norma->activa = 0;
        $norma->save();

        return response()->json(['success' => true, 'message' => 'Norma desactivada correctamente.']);
    }
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:normas,id',
        
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
