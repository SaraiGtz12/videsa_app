<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServicioController extends Controller
{
   public function obtenerServicios()
{
    // Simulación de usuario logueado
    $usuario = (object) ['id_usuario' => 3];

    $ordenes = DB::table('ordenes_servicios as os')
        ->join('datos_servicios as ds', 'os.id_orden_servicio', '=', 'ds.id_orden_servicio')
        ->join('normas as n', 'ds.id_norma', '=', 'n.id_norma')
        ->join('clientes as c','os.id_cliente','=','c.id_cliente')
        ->join('sucursales as s','c.id_cliente','=','s.id_cliente')
        ->select(
            'os.numero_servicio',
            'os.created_at as fecha_registro',
            'n.nombre AS nombre_norma',
            'ds.descripcion',
            'ds.id_datos_servicio',
            'c.razon_social',
            's.calle',
            's.numero',
            's.colonia',
            's.ciudad',
            's.estado',
            's.codigo_postal'
        )
        ->where('os.muestreador_asignado', $usuario->id_usuario)
        ->get();

    $servicios = $ordenes->map(function($item) {
        return [
            'id' => $item->id_datos_servicio,
            'nombre' => $item->nombre_norma,
            'cliente' => $item->razon_social,
            'descripcion' => $item->descripcion,
            'direccion' => $item->calle . ' ' . $item->numero . ', ' . $item->colonia . ', ' . $item->ciudad
        ];
    });

    return response()->json($servicios);
}

}
