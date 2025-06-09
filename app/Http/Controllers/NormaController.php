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
}
