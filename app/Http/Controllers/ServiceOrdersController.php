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
    public function RegistrarOrden(Request $request){
        $request->validate([
            "RazonSocial" => "requiered|string",
            "Calle" => "requiered|string",
            "Colonia" => "requiered|string",
            "Responsable" => "requiered|string",
            "Municipio" => "requiered|string",
            "Referencias" => "requiered|string",
            "CargoResponsable" => "requiered|string",
            "Estado" => "requiered|string",
            "Telefono" => "requiered|string",
            "Descripcion[]" => "requiered|string",
            "FechaMuestreo" => "required|date",
            "Puntos[]" => "requiered|integer",
            "Muestreador" => "required|string"
            #"muestreador[]" => "requiered|string",
        ]);

        try{
            $cliente = new Client();
            $cliente->customerName = $request->RazonSocial;
            $cliente->save();

            $clienteId = $cliente->idClient;

            $direccion = new Address();
            $direccion->street = $request->Calle;
            $direccion->neighborhood = $request->Colonia;
            $direccion->city = $request->Municipio;
            $direccion->state = $request->Estado;
            $direccion->references = $request->Referencias;
            $direccion->clientId = $clienteId;

            $direccionId = $direccion->idAddress;

            $numeroOrden = ServiceOrder::latest('idServiceOrder')->first();
            
            if(!$numeroOrden){
                $numeroOrden = 1;
            }else{
                $numeroOrden = $numeroOrden+1;
            }

            $usuario = Auth::user();

            $OrdenServicio = new ServiceOrder();
            $OrdenServicio->serviceOrder = "25-".$numeroOrden;
            $OrdenServicio->responsible = $request->Responsable;
            $OrdenServicio->phoneNumber = $request->Telefono;
            $OrdenServicio->AssignedTo = $request->Muestreador;
            $OrdenServicio->userId = $usuario->idUser;
            $OrdenServicio->addressId = $direccionId;

            $OrdenServicioId = $OrdenServicio->idServiceOrder;

            
        }catch(Exception $e){
            Log::error("Algo Salio Mal: ".$e->getMessage());
        }


    }
}
