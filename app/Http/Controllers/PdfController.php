<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\detalles_medicion_nom085;
use App\Models\OrdenTrabajo;
use App\Models\dato_campo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

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
        ->join('normas AS n','informes.id_norma','n.id_norma')
        ->join('usuarios AS u','os.muestreador_asignado','u.id_usuario')
        ->where('os.id_orden_servicio', $id)
        ->select(
            'u.nombre as muestreador',
            'n.nombre','n.descripcion','os.responsable','os.cargo','os.telefono','os.muestreador_asignado',
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

    $datos_campo = dato_campo::where('id_informe', $detalle->id_informe)->get();
        $nox = $datos_campo->pluck('nox')->toArray();
        $co = $datos_campo->pluck('co_ppmv')->toArray();
        $o2 = $datos_campo->pluck('o2')->toArray();
        $co2 = $datos_campo->pluck('co2')->toArray();
        // Generar las gráficas
        $grafica_nox = $this->generarGraficaBase64('NOx (ppmv)', $nox, 'red');
        $grafica_co = $this->generarGraficaBase64('CO (ppmv)', $co, 'green');
        $grafica_o2 = $this->generarGraficaBase64('O2 (%)', $o2, 'blue');
        $grafica_co2 = $this->generarGraficaBase64('CO2 (%)', $co2, 'orange');


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
        'datos_campo' => $datos_campo,
        'datos_campo' => $datos_campo,
        'grafica_nox' => $grafica_nox,
        'grafica_co' => $grafica_co,
        'grafica_o2' => $grafica_o2,
        'grafica_co2' => $grafica_co2,

    ];

    $pdf = \PDF::loadView('pdf.template085MG', $data);

    return $pdf->stream("informe_{$detalle->numero_servicio}_{$detalle->numero_informe}.pdf");
}

private function generarGraficaBase64($label, $datos, $color = 'blue')
{
    $url = 'https://quickchart.io/chart';

    // Asegúrate de limpiar los datos (por si hay nulls)
    $datos = array_filter($datos, fn($v) => $v !== null);
    
    // Calcula el mínimo y máximo
    $min = min($datos);
    $max = max($datos);

    $chartConfig = [
        'type' => 'line',
        'data' => [
            'labels' => range(1, count($datos)),
            'datasets' => [[
                'label' => $label,
                'data' => array_values($datos), // por si se usó array_filter
                'fill' => false,
                'borderColor' => $color,
                'tension' => 0.3
            ]]
        ],
        'options' => [
            'plugins' => [
                'title' => [
                    'display' => true,
                    'text' => $label
                ]
            ],
            'scales' => [
                'y' => [
                    'min' => floor($min),  // puedes ajustar con ceil/floor si quieres redondear
                    'max' => ceil($max)
                ]
            ]
        ]
    ];

    $response = Http::get($url, [
        'c' => json_encode($chartConfig),
        'format' => 'png',
        'width' => 500,
        'height' => 200
    ]);

    if ($response->ok()) {
        return 'data:image/png;base64,' . base64_encode($response->body());
    }

    return null;
}





}
