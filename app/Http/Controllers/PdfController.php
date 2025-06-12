<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\detalles_medicion_nom085;
use App\Models\OrdenTrabajo;
use Carbon\Carbon;

class PdfController extends Controller
{
    // public function generarPDF(Request $request)
    // {
    //     $request->validate([
    //         'fecha_evaluacion' => 'required|date',
    //         'equipo_evaluado' => 'required|string',

    //         'nox' => 'required|array',
    //         'co' => 'required|array',
    //         'o2' => 'required|array',
    //         'co2' => 'required|array',
    //         'temp' => 'required|array',
    //     ]);

    //     $nox = $request->input('nox');  
    //     $co = $request->input('co');
    //     $o2 = $request->input('o2');
    //     $co2 = $request->input('co2');
    //     $temp = $request->input('temp');

    //     $urlNox = $this->buildChartUrl('NOX', $nox, 'blue');
    //     $urlCo = $this->buildChartUrl('CO', $co, 'red');
    //     $urlO2 = $this->buildChartUrl('O2', $o2, 'green');
    //     $urlCo2 = $this->buildChartUrl('CO2', $co2, 'orange');

    //     $imgNox = $this->getBase64FromUrl($urlNox);
    //     $imgCo = $this->getBase64FromUrl($urlCo);
    //     $imgO2 = $this->getBase64FromUrl($urlO2);
    //     $imgCo2 = $this->getBase64FromUrl($urlCo2);

    //     $filas = [];
    //     $numFilas = count($nox);

    //     for ($i = 0; $i < $numFilas; $i++) {
    //         $filas[] = [
    //             'no' => $i + 1,
    //             'nox' => $nox[$i],
    //             'co' => $co[$i],
    //             'o2' => $o2[$i],
    //             'co2' => $co2[$i],
    //             'temp' => $temp[$i],
    //         ];
    //     }

    //     $data = [
    //         'numero_informe' => 'INF-' . rand(1000, 9999),
    //         'orden_servicio' => 'OS-' . rand(1000, 9999),
    //         'fecha_evaluacion' => $request->fecha_evaluacion,
    //         'recepcion' => now()->format('Y-m-d'),
    //         'fecha_informe' => now()->format('Y-m-d'),
            
    //         'equipo_evaluado' => $request->equipo_evaluado,

    //         'filas' => $filas,
    //         'imgNox' => $imgNox,
    //         'imgCo' => $imgCo,
    //         'imgO2' => $imgO2,
    //         'imgCo2' => $imgCo2,
    //     ];

    //     $pdf = Pdf::loadView('pdf.template085MG', $data);

    //     return $pdf->stream('Informe085MG.pdf'); 
    // }

    // private function buildChartUrl($label, $data, $color)
    // {
    //     $chart = [
    //         'type' => 'line',
    //         'data' => [
    //             'labels' => range(1, count($data)),
    //             'datasets' => [[
    //                 'label' => $label,
    //                 'data' => $data,
    //                 'fill' => false,
    //                 'borderColor' => $color,
    //             ]],
    //         ],
    //         'options' => [
    //             'title' => [
    //                 'display' => true,
    //                 'text' => "$label (ppmv)"
    //             ],
    //             'legend' => [
    //                 'display' => false
    //             ],
    //             'scales' => [
    //                 'xAxes' => [[
    //                     'display' => true,
    //                     'scaleLabel' => [
    //                         'display' => true,
    //                         'labelString' => 'No.'
    //                     ]
    //                 ]],
    //                 'yAxes' => [[
    //                     'display' => true,
    //                     'scaleLabel' => [
    //                         'display' => true,
    //                         'labelString' => 'Valor'
    //                     ]
    //                 ]]
    //             ]
    //         ]
    //     ];

    //     return "https://quickchart.io/chart?c=" . urlencode(json_encode($chart));
    // }

    // private function getBase64FromUrl($url)
    // {
    //     $imageData = @file_get_contents($url);
    //     if ($imageData === false) {
    //         return '';
    //     }
    //     return 'data:image/png;base64,' . base64_encode($imageData);
    // }

public function generarPDF()
{
    $orden_trabajo_id=1;
        $detalle = detalles_medicion_nom085::where('orden_trabajo_id', $orden_trabajo_id)->first();
         if (!$detalle) {
            return response()->json(['error' => 'No se encontraron datos para esta orden de trabajo.'], 404);
        }

        $now = Carbon::now();
        $fecha_formateada = $now->format('d/m/Y'); 
        $fecha_informe_compacta = $now->format('ymd'); // yyMMdd → 250611
        $contador = OrdenTrabajo::whereYear('created_at', $now->year)->count() + 1;

        $contador_formateado = str_pad($contador, 2, '0', STR_PAD_LEFT);

        $numero_informe = 'FE085MG/' . $fecha_informe_compacta . '-' . $contador_formateado;

        $fecha_informe = Carbon::now()->format('d/m/Y');
        $pdf = \PDF::loadView('pdf.template085MG', compact('detalle', 'fecha_informe','numero_informe'));

         return $pdf->download('medicion_nom085.pdf');

    // $data = [
    //     'numero_informe' => 'FE085MG/250405-01',
    //     'orden_servicio' => '25-1347',
    //     'fecha_evaluacion' => '5-ABRIL-25',
    //     'recepcion' => '6-ABRIL-25',
    //     'fecha_informe' => '11-ABRIL-25',
    //     'equipo_evaluado' => 'Equipo de prueba',
    // ];

    // $pdf = Pdf::loadView('pdf.template085MG', $data);

    // return $pdf->stream('informe.pdf'); 
    // return $pdf->download('informe.pdf'); // para descargar automáticamente
}


}
