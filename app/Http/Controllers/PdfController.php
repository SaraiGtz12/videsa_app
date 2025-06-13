<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\detalles_medicion_nom085;
use App\Models\OrdenTrabajo;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PdfController extends Controller
{
    
public function generarPDF($id)
{
    $detalle = \DB::table('informes')
        ->join('datos_servicios as ds', 'informes.id_datos_servicio', '=', 'ds.id_datos_servicio')
        ->join('ordenes_servicios as os', 'ds.id_orden_servicio', '=', 'os.id_orden_servicio')
        ->join('clientes as c', 'os.id_cliente', '=', 'c.id_cliente')
        ->join('sucursales as s', 'c.id_cliente', '=', 's.id_cliente')
        ->join('zonas_geograficas as zg', 'informes.id_zona_geografica', '=', 'zg.id_zona_geografica')
        ->join('tipos_combustibles as tc', 'informes.combustible_utilizado', '=', 'tc.id_tipo_combustible')
        ->where('os.id_orden_servicio', $id)
        ->select(
            'os.numero_servicio',
            'os.fecha_muestreo',
            'c.razon_social as cliente',
            's.nombre as nombre_sucursal',
            's.calle', 's.numero', 's.colonia', 's.estado','s.ciudad', 's.codigo_postal',
            'zg.codigo',
            'tc.tipo','informes.cpacidad_termica_nominal',
            'informes.*'
        )
        ->first();

    if (!$detalle) {
        return redirect()->back()->with('error', 'No se encontró información para este informe.');
    }

    $data = [
        'detalle' => $detalle,
        'numero_servicio' => $detalle->numero_servicio,
        'nombre_sucursal' => $detalle->nombre_sucursal,
        'codigo' => $detalle->codigo,
        'id_zona_geografica' => $detalle->id_zona_geografica,
        'numero_informe' => $detalle->numero_informe ?? 'N/A',
        'fecha_informe' => now()->format('d/m/Y'),
        'fecha_muestreo' => \Carbon\Carbon::parse($detalle->created_at)->format('d/m/Y'),
        'equipo_evaluado' => $detalle->equipo_evaluado ?? 'No especificado',
    ];

    $pdf = \PDF::loadView('pdf.template085MG', $data);

    return $pdf->stream("informe_{$detalle->numero_servicio}_{$detalle->numero_informe}.pdf");
}



}
