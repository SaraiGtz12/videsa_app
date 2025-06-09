<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Nom_085_Campo_Controller extends Controller
{
    private $factores_longuitud_kl = [
        "4_puntos_transversales_diametro" => [
            "1" => 0.067,
            "2" => 0.25,
            "3" => 0.75,
            "4" => 0.933
        ],
        "6_puntos_transversales_diametro" => [
            "1" => 0.044,
            "2" => 0.147,
            "3" => 0.295,
            "4" => 0.705,
            "5" => 0.853,
            "6" => 0.956
        ],
        "8_puntos_transversales_diametro" => [
            "1" => 0.033,
            "2" => 0.105,
            "3" => 0.194,
            "4" => 0.323,
            "5" => 0.677,
            "6" => 0.806,
            "7" => 0.895,
            "8" => 0.967
        ],
        "10_puntos_transversales_diametro" => [
            "1" => 0.025,
            "2" => 0.082,
            "3" => 0.146,
            "4" => 0.226,
            "5" => 0.342,
            "6" => 0.658,
            "7" => 0.774,
            "8" => 0.854,
            "9" => 0.918,
            "10" => 0.975
        ],
        "12_puntos_transversales_diametro" => [
            "1" => 0.021,
            "2" => 0.067,
            "3" => 0.118,
            "4" => 0.177,
            "5" => 0.250,
            "6" => 0.355,
            "7" => 0.645,
            "8" => 0.750,
            "9" => 0.823,
            "10" => 0.882,
            "11" => 0.933,
            "12" => 0.979
        ],
        "14_puntos_transversales_diametro" => [
            "1" => 0.018,
            "2" => 0.057,
            "3" => 0.099,
            "4" => 0.146,
            "5" => 0.201,
            "6" => 0.269,
            "7" => 0.366,
            "8" => 0.634,
            "9" => 0.731,
            "10" => 0.799,
            "11" => 0.854,
            "12" => 0.901,
            "13" => 0.943,
            "14" => 0.982
        ],
        "16_puntos_transversales_diametro" => [
            "1" => 0.016,
            "2" => 0.049,
            "3" => 0.085,
            "4" => 0.125,
            "5" => 0.169,
            "6" => 0.220,
            "7" => 0.283,
            "8" => 0.375,
            "9" => 0.625,
            "10" => 0.717,
            "11" => 0.780,
            "12" => 0.831,
            "13" => 0.875,
            "14" => 0.915,
            "15" => 0.951,
            "16" => 0.984
        ]
    ];

    public function generar_datos(){

    }
    
    private function calcular_marcado_sonda($diametro_int_c, $extencion_puerto){
        return [
            'marcado1' => number_format((($diametro_int_c*(1/6))+$extencion_puerto),2),
            'marcado2' => number_format((($diametro_int_c*(1/2))+$extencion_puerto),2),
            'marcado3' => number_format((($diametro_int_c*(5/6))+$extencion_puerto),2)
        ];
    }

    private function calcular_promedios_campo($data_campo){
        $total_muestras = count($data_campo);
			$sumas = [
				'nox' => 0,
				'co' => 0,
				'o2' => 0,
				'co2' => 0,
				'temp' => 0
			];

			foreach($data_campo as $muestra) {
				$sumas['nox'] += $muestra['nox'];
				$sumas['co'] += $muestra['co'];
				$sumas['o2'] += $muestra['o2'];
				$sumas['co2'] += $muestra['co2'];
				$sumas['temp'] += $muestra['temp'];
			}

			return [
				'nox' => $sumas['nox'] / $total_muestras,
				'co' => $sumas['co'] / $total_muestras,
				'o2' => $sumas['o2'] / $total_muestras,
				'co2' => $sumas['co2'] / $total_muestras,
				'temp' => $sumas['temp'] / $total_muestras
			];
    }

    private function calcular_estratificacion($concentraciones){
        $concentracion_ppm1 = $concentraciones[0]['concentracion1'];
        $concentracion_ppm2 = $concentraciones[0]['concentracion2'];
        $concentracion_ppm3 = $concentraciones[0]['concentracion3'];

        $concentracion_promedio = number_format(($concentracion_ppm1 + $concentracion_ppm2 + $concentracion_ppm3) / 3, 2);

        $estratificacion1 = number_format(($concentracion_promedio == 0) ? 0 : abs(($concentracion_promedio - $concentracion_ppm1) / $concentracion_promedio) * 100, 2);
        $estratificacion2 = number_format(($concentracion_promedio == 0) ? 0 : abs(($concentracion_promedio - $concentracion_ppm2) / $concentracion_promedio) * 100, 2);
        $estratificacion3 = number_format(($concentracion_promedio == 0) ? 0 : abs(($concentracion_promedio - $concentracion_ppm3) / $concentracion_promedio) * 100, 2);

        $ppm1 = number_format(abs($concentracion_promedio - $concentracion_ppm1), 2);
        $ppm2 = number_format(abs($concentracion_promedio - $concentracion_ppm2), 2);
        $ppm3 = number_format(abs($concentracion_promedio - $concentracion_ppm3), 2);

        return [
            'concentraciones' => [
                'concentracion_1' => $concentracion_ppm_1,
                'concentracion_2' => $concentracion_ppm_2,
                'concentracion_3' => $concentracion_ppm_3,
                'promedio' => $concentracion_promedio
            ],
            'estratificacion' => [
                'estratificacion_1' => $estratificacion_1,
                'estratificacion_2' => $estratificacion_2,
                'estratificacion_3' => $estratificacion_3,
                'estratMaxima' => max($estratificacion_1, $estratificacion_2, $estratificacion_3)
            ],
            'ppm' => [
                'ppm1' => $ppm1,
                'ppm2' => $ppm2,
                'ppm3' => $ppm3,
                'ppmMaxima' => max($ppm1, $ppm2, $ppm3)
            ]
        ];
    }

    private function determincacion_conclusiones($estra_max, $ppm_max){
        // Puntos para estratificación
        $puntos_estrat = ($estrat_max <= 5) ? 1 : 
                    (($estrat_max <= 10) ? 3 : 12);
        
        // Puntos para ppm
        $puntos_ppm = ($ppm_max <= 0.5) ? 1 : 
                    (($ppm_max <= 1) ? 3 : 12);
        
        $puntos_finales = min($puntos_estrat, $puntos_ppm);
        
        $conclusion = "No Estratificada";
        if($puntos_finales == 3) {
            $conclusion = "Minimamente Estratificada";
        } elseif($puntos_finales == 12) {
            $conclusion = "Estratificada";
        }
        
        return [
            'puntosFinales' => $puntos_finales,
            'conclusion' => $conclusion
        ];
    }

    //$diametro_int_c, $extencion_puerto
    // public function distribucion_puntos_estratificacion($puntos_finales = 12, $tipo_conducto = "Circular") {
    //     if($puntos_finales == 12 && $tipo_conducto == "Circular") {
    //         // Aquí debes especificar qué vista quieres retornar
    //         return view('nombre.de.tu.vista', [
    //             'factores' => $this->factores_longuitud_kl
    //         ]);
    //     }
        
    //     return [
    //         "resultado" => "N/A"  // Corregido el typo
    //     ];
    // }
}
