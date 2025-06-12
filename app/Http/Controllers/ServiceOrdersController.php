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
                    'codigo'=> $codigo,
                    'usuario_asignado' => $request->input('Muestreador'),
                    'usuario_creador'=> '2',
                    'id_norma'=> $servicios[$i],  
                    'id_cliente'=> $request->input('empresa'),
                    'id_sucursal'=> $request->input('empresa'),
                    'fecha_evaluacion' => $request->input('FechaMuestreo'),
                    'fecha_reconocimiento'=> Carbon::now(),
                    'estado'=> '2'
                ]);
                
            }
            

       
            return redirect()->back()->with('success', 'Orden(es) registrada(s) correctamente.');

    }




}
