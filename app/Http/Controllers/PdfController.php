<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode; //ESTA LIBRERIA ES PARA LA FIRMA ELECTRONICA 

class PdfController extends Controller
{
 

public function generatePdf085G(Request $request)
{
    $qr = \QrCode::size(100)->generate('https://tusitio.com/verificar/085G');

    $datos = [
        'qr' => $qr,
        'numero_informe' => 'FE085G/250405-01',
        'orden_servicio' => '25-1347',
        'fecha_evaluacion' => '5-ABRIL-25',
        'recepcion' => '6-ABRIL-25',
        'fecha_informe' => '11-ABRIL-25',

        'grafica_co' => $request->input('grafica_co'), 
        'grafica_o2' => $request->input('grafica_o2'),
        'grafica_co2' => $request->input('grafica_co2'),

        'mostrar_boton' => true // bandera para mostrar botón solo en navegador
    ];
     // Datos de la tabla de analitos
        $analito_no = [1, 2, 3, 4, 5, 6, 7,8,9,10,11,12,13,14,15];
        $analito_CO = [24, 27, 28, 24, 26, 26,28,27,26,25,25,25,27,24,27];
        $analito_O2 = [4.42, 4.42, 4.22, 4.22, 4.34, 4.48,4.35,4.34,4.41,4.23,4.43,4.26,4.42,4.28,4.35];
        $analito_CO2 = [9.80, 11.10, 11.13, 11.43, 10.42, 11.25,9.45,11.55,10.89,10.68,10.08,11.27,11.22,10.92,10.33];
        $analito_temp = [188.4, 191.5, 190.5, 193.3, 192.7,192.2,191.5,189.3,188.6,192.4,190.4,192.4,192.8,190.4,190.2];

        // Agrupamos todos los datos en un solo array para pasar a la vista
        $datos_analito = [
            'analito_no' => $analito_no,
            'analito_CO' => $analito_CO,
            'analito_O2' => $analito_O2,
            'analito_CO2' => $analito_CO2,
            'analito_temp' => $analito_temp
        ];

        $datos_completos = array_merge($datos, $datos_analito, ['modo' => $request->has('descargar') ? 'pdf' : 'web']);

        if ($request->has('descargar')) {
            $pdf = \PDF::loadView('pdf.template085G', $datos_completos);
            return $pdf->download('plantilla085G.pdf');
        }

        return view('pdf.template085G', $datos_completos);
    }

 public function generatePdf085MG(Request $request)
    {
        $qr = \QrCode::size(100)->generate('https://tusitio.com/verificar/085MG');

        // Datos fijos del encabezado
        $datos = [
            'qr' => $qr,
            'numero_informe' => 'FE085MG/250405-01',
            'orden_servicio' => '25-1347',
            'fecha_evaluacion' => '5-ABRIL-25',
            'recepcion' => '6-ABRIL-25',
            'fecha_informe' => '11-ABRIL-25',

            'grafica_co' => $request->input('grafica_co'), 
            'grafica_o2' => $request->input('grafica_o2'),
            'grafica_co2' => $request->input('grafica_co2'),
   
            
            'mostrar_boton' => true
        ];

        // Datos de la tabla de analitos
        $analito_no = [1, 2, 3, 4, 5, 6, 7,8,9,10,11,12,13,14,15];
        $analito_CO = [24, 27, 28, 24, 26, 26,28,27,26,25,25,25,27,24,27];
        $analito_O2 = [4.42, 4.42, 4.22, 4.22, 4.34, 4.48,4.35,4.34,4.41,4.23,4.43,4.26,4.42,4.28,4.35];
        $analito_CO2 = [9.80, 11.10, 11.13, 11.43, 10.42, 11.25,9.45,11.55,10.89,10.68,10.08,11.27,11.22,10.92,10.33];
        $analito_temp = [188.4, 191.5, 190.5, 193.3, 192.7,192.2,191.5,189.3,188.6,192.4,190.4,192.4,192.8,190.4,190.2];

        // Agrupamos todos los datos en un solo array para pasar a la vista
        $datos_analito = [
            'analito_no' => $analito_no,
            'analito_CO' => $analito_CO,
            'analito_O2' => $analito_O2,
            'analito_CO2' => $analito_CO2,
            'analito_temp' => $analito_temp
        ];

        $datos_completos = array_merge($datos, $datos_analito, ['modo' => $request->has('descargar') ? 'pdf' : 'web']);

        if ($request->has('descargar')) {
            $pdf = \PDF::loadView('pdf.template085MG', $datos_completos);
            return $pdf->download('plantilla085MG.pdf');
        }

        return view('pdf.template085MG', $datos_completos);
    }

 public function generatePdf085ML(Request $request)
{
    $qr = \QrCode::size(100)->generate('https://tusitio.com/verificar/085ML');

    $datos = [
        'qr' => $qr,
        'numero_informe' => 'FE085ML/250405-01',
        'orden_servicio' => '25-1347',
        'fecha_evaluacion' => '5-ABRIL-25',
        'recepcion' => '6-ABRIL-25',
        'fecha_informe' => '11-ABRIL-25',
        'mostrar_boton' => true // bandera para mostrar botón solo en navegador
    ];

    if ($request->has('descargar')) {
        $pdf = \PDF::loadView('pdf.template085ML', array_merge($datos, ['modo' => 'pdf']));
        return $pdf->download('plantilla085ML.pdf');
    }
    return view('pdf.template085ML', array_merge($datos, ['modo' => 'web']));
}

 public function generatePdf085L(Request $request)
{
    $qr = \QrCode::size(100)->generate('https://tusitio.com/verificar/085L');

    $datos = [
        'qr' => $qr,
        'numero_informe' => 'FE085L/250422-01',
        'orden_servicio' => '25-1425',
        'fecha_evaluacion' => '22-ABRIL-25',
        'recepcion' => '23-ABRIL-25',
        'fecha_informe' => '30-ABRIL-25',
        'mostrar_boton' => true // bandera para mostrar botón solo en navegador
    ];

    if ($request->has('descargar')) {
        $pdf = \PDF::loadView('pdf.template085L', array_merge($datos, ['modo' => 'pdf']));
        return $pdf->download('plantilla085L.pdf');
    }
    return view('pdf.template085L', array_merge($datos, ['modo' => 'web']));
}







}