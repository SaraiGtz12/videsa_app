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

use App\Models\OrdenTrabajo;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ServiceOrdersController extends Controller
{
    public function guardar(Request $request)
    {
    //dd($request->all());die;
        $request->validate([
            'empresa' => 'required|integer',
            'sucursal' => 'required|integer',
            'Servicio' => 'required|array',
            'Servicio.*' => 'required|integer',
            'FechaMuestreo' => 'required|date',
            'Muestreador' => 'required|string|max:255',
            'Cantidad' => 'required|integer'

        ]);

        $year = date('y'); 
        $contador = OrdenTrabajo::count() + 1;
        $codigo = $year . '-' . str_pad($contador, 3, '0', STR_PAD_LEFT);



            $servicios = $request->input('Servicio');
            $puntos = $request->input('Puntos');
            $descripciones = $request->input('Descripcion'); 
            
            for ($i = 0; $i < count($servicios); $i++) {
                OrdenTrabajo::create([
                    'orden_servicio'=> $codigo,
                    'muestreador_asignado' => $request->input('Muestreador'),
                    'id_cliente'=> $request->input('empresa'),
                    'id_sucursal'=> $request->input('sucursal'),
                    'fecha_muestreo' => $request->input('FechaMuestreo'),
                    'estatus'=> 2
                ]);
                
            }
            

       
            return redirect()->back()->with('success', 'Orden(es) registrada(s) correctamente.');

    }




}
