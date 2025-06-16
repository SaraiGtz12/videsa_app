<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrdenServicio_Controller extends Controller
{
    public function obtener_sucursal($id){
        Log::info("Los datos que llegaron son: ". $id);

        $sucursales_obtenidas = Sucursal::where('id_cliente', $id)->get();
        return response()->json([
            'status' => 'success',
            'sucursales_obtenidas' => $sucursales_obtenidas,
        ]);
    }
}
