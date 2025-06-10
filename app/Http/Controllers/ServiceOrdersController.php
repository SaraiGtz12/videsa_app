<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Client;
use App\Models\ServiceOrder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ServiceOrdersController extends Controller
{
    public function guardar(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000',
        ]);

        Servicio::create([
            'codigo' => $request->norma,
            'usuario_asignado' => $request->usuario_asignado,
            'usuario_creador' => $request->usuario_creador,
            'activa' => 1,
        ]);

        return redirect()->back()->with('success', 'Orden registrada exitosamente.');
    }


}
