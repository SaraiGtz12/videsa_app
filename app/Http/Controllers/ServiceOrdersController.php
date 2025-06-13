<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Client;
use App\Models\datos_servicio;
use App\Models\orden_servicio;
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
            'Muestreador' => 'required|integer',
            'Cantidad' => 'required|integer',
            'Descripcion' => 'required|array',
            'Descripcion.*' => 'required|string',
            'nombre_responsable' => 'required|string',
            'cargo_responsable' => 'required|string',
            'telefono' => 'required|string'

        ]);

        $year = date('y'); 
        $contador = orden_servicio::count() + 1;
        $codigo = $year . '-' . str_pad($contador, 3, '0', STR_PAD_LEFT);

        $servicios = $request->input('Servicio');
        $descripciones = $request->input('Descripcion'); 

        $orden = orden_servicio::create([
            'numero_servicio'=> $codigo,
            'muestreador_asignado' => $request->input('Muestreador'),
            'id_cliente'=> $request->input('empresa'),
            'id_sucursal'=> $request->input('sucursal'),
            'fecha_muestreo' => $request->input('FechaMuestreo'),
            'id_estatus'=> 3,
            'responsable' => $request->nombre_responsable,
            'cargo' => $request->cargo_responsable,
            'telefono' => $request->telefono
        ]);

        $id_orden = $orden->id_orden_servicio;

        $estado = false;

        try{
            for ($i = 0; $i < $request->input('Cantidad'); $i++) {
                $datos_s = datos_servicio::create([
                    'descripcion' => $descripciones[$i],
                    'id_norma' =>  $servicios[$i],
                    'id_orden_servicio' => $id_orden
                ]);

                if($datos_s){
                    $estado = true;
                }else{
                    $estado = false;
                }
            }

            if($orden && $estado){
                return redirect()->back()->with('success', 'Orden(es) registrada(s) correctamente.');
            }else{
                return redirect()->back()->withErrors('error', 'Ocurrio un error al registrar la(s) orden(es) de servcio(s)');
            }

        }catch(Exception $e){
            Log::error('Error en la creación de datos servicios: '.$e->getMessage());
        }   
        

        return redirect()->back()->with('success', 'Orden(es) registrada(s) correctamente.');

    }




}
