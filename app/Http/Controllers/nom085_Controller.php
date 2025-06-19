<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\dato_campo;
use App\Models\informe;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

class nom085_Controller extends Controller
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

    public function registrar_nom085_mg(Request $request){
        try{
            $request->validate([
                "fecha_evaluacion" => "required|date",
                "empresa" => "required|integer",
                "equipo_evaluado" => "required|string",
                "marca" => "required|string|max:255",
                "combustible_utilizado" => "required|string|max:255",
                "anio" => "required|integer",
                "capacidad_termica" => "required|integer",
                "altura" => "required|integer",
                "presion_estatica" => "required|numeric",
                "geometria_conductor" => "required|string|max:255",
                "diametro_i_d" => "required|numeric",
                "diametro_equivalente" => "required|numeric",
                "largo_trasversal" => "required|integer",
                "ancho_transversal" => "required|integer",
                "num_puerto" => "required|integer|min:1",
                "extencion_puerto" => "required|numeric",
                "d_a" => "required|numeric",
                "d_b" => "required|numeric",
                "d_c" => "required|numeric",
                "num_d_a" => "required|numeric",
                "num_d_b" => "required|numeric",
                "num_d_c" => "required|numeric",
                // Validación como arrays con elementos numéricos
                "nox" => "required|array",
                "nox.*" => "numeric",
                "co" => "required|array",
                "co.*" => "numeric",
                "o2" => "required|array",
                "o2.*" => "numeric",
                "co2" => "required|array",
                "co2.*" => "numeric",
                "temp" => "required|array",
                "temp.*" => "numeric"
            ]);

            Log::info("----------------------------\nLos datos llegaron: ",$request->all());

            $marcado_sonda = $this->calcular_marcado_sonda($request->diametro_i_d, $request->extencion_puerto);
            Log::info("Datos Obtenidos por el marcado de la sonda: ",$marcado_sonda);

            $marcado_1 = $marcado_sonda['marcado_1'];
            $marcado_2 = $marcado_sonda['marcado_2'];
            $marcado_3 = $marcado_sonda['marcado_3'];

            $promedios_obtenidos = $this->calcular_promedios_campo($request->nox, $request->co, $request->o2, $request->co2, $request->temp);
            Log::info("Datos Obtenidos por el marcado de la sonda: ",$promedios_obtenidos);

            $promedio_nox = $promedios_obtenidos['nox'];
            $promedio_co = $promedios_obtenidos['co'];
            $promedio_o2 = $promedios_obtenidos['o2'];
            $promedio_co2 = $promedios_obtenidos['co2'];
            $promedio_temp = $promedios_obtenidos['temp'];

            $analisis_Nox = $this->analizarValoresNox($request->nox);
            Log::info("Datos Obtenidos de los min, max y promedio de nox: ",$analisis_Nox);

            $valor_nox_1 = $analisis_Nox['minimo'];
            $valor_nox_2 = $analisis_Nox['mediana'];
            $valor_nox_3 = $analisis_Nox['maximo'];

            $resultados_estratifciacion = $this->calcular_estratificacion($valor_nox_1, $valor_nox_2, $valor_nox_3);
            Log::info("Datos Obtenidos de la estratificación son: ",$resultados_estratifciacion);

            $max_estra = $resultados_estratifciacion['estratificacion']['estratMaxima'];
            $max_ppm = $resultados_estratifciacion['ppm']['ppmMaxima'];

            $determinacion_conclusiones = $this->determincacion_conclusiones($max_estra, $max_ppm);
            Log::info("Datos Obtenidos de la conclusión: ",$determinacion_conclusiones);

            $presion = 760 * exp(-0.000117 * $request->altura);

            try{
                $detalles_medicion_nom085 = new informe();
                $detalles_medicion_nom085->orden_trabajo_id = "1";
                $detalles_medicion_nom085->equipo_id ="1";
                $detalles_medicion_nom085->combustible_utilizado = $request->combustible_utilizado;
                $detalles_medicion_nom085->capacidad_termica = $request->capacidad_termica;
                $detalles_medicion_nom085->altura_msnm = $request->altura;
                $detalles_medicion_nom085->precision_estatica = $request->presion_estatica;
                $detalles_medicion_nom085->precion_barometrica = $presion;
                $detalles_medicion_nom085->anyo = $request->anio;
                $detalles_medicion_nom085->geometria_conducto = $request->geometria_conductor;
                $detalles_medicion_nom085->diametro_conducto = $request->diametro_i_d;
                $detalles_medicion_nom085->diametro_equivalente =$request->diametro_equivalente;
                $detalles_medicion_nom085->largo_transversal = $request->largo_trasversal;
                $detalles_medicion_nom085->ancho_transversal = $request->ancho_transversal;
                $detalles_medicion_nom085->numero_puertos = $request->num_puerto;
                $detalles_medicion_nom085->extencion_puerto = $request->extencion_puerto;
                $detalles_medicion_nom085->puntos_seleccionados_medicion = $determinacion_conclusiones['puntosFinales'];
                $detalles_medicion_nom085->distancia_a = $request->d_a;
                $detalles_medicion_nom085->distancia_b = $request->d_b;
                $detalles_medicion_nom085->distancia_c = $request->d_c;
                $detalles_medicion_nom085->numero_diametro_a = $request->num_d_a;
                $detalles_medicion_nom085->numero_diametro_b = $request->num_d_b;
                $detalles_medicion_nom085->numero_diametro_c = $request->num_d_c;
                $detalles_medicion_nom085->marcado_sonda_1 = $marcado_1;
                $detalles_medicion_nom085->marcado_sonda_2 = $marcado_2;
                $detalles_medicion_nom085->marcado_sonda_3 = $marcado_3;
                $detalles_medicion_nom085->concentracion_1 = $valor_nox_1;
                $detalles_medicion_nom085->concentracion_2 = $valor_nox_2;
                $detalles_medicion_nom085->concentracion_3 = $valor_nox_3;
                $detalles_medicion_nom085->estratificacion_1  = $resultados_estratifciacion['estratificacion']['estratificacion_1'];
                $detalles_medicion_nom085->estratificacion_2  = $resultados_estratifciacion['estratificacion']['estratificacion_2'];
                $detalles_medicion_nom085->estratificacion_3  = $resultados_estratifciacion['estratificacion']['estratificacion_3'];
                $detalles_medicion_nom085->ppm_1 = $resultados_estratifciacion['ppm']['ppm1'];
                $detalles_medicion_nom085->ppm_2 = $resultados_estratifciacion['ppm']['ppm2'];
                $detalles_medicion_nom085->ppm_3 = $resultados_estratifciacion['ppm']['ppm3'];
                $detalles_medicion_nom085->promedio_concentracion = $resultados_estratifciacion['concentraciones']['promedio'];
                $detalles_medicion_nom085->max_estratificacion = $resultados_estratifciacion['estratificacion']['estratMaxima'];
                $detalles_medicion_nom085->max_ppm = $resultados_estratifciacion['ppm']['ppmMaxima'];
                $detalles_medicion_nom085->conclusion = $determinacion_conclusiones['conclusion'];
                $detalles_medicion_nom085->puntos_finales = $determinacion_conclusiones['puntosFinales'];

                $detalles_medicion_nom085->save();

                if($detalles_medicion_nom085){
                    Log::info("Se guardo los detalles de la nom085");
                }

                $id_detalle = $detalles_medicion_nom085->id;

                $contador = 0;
                
                foreach ($request->nox as $index => $valor) {
                    dato_campo::create([
                        'id_medicion' => $contador,
                        'nox' => $request->nox[$index],
                        'co_ppmv' => $request->co[$index],
                        'o2' => $request->o2[$index],
                        'co2' => $request->co2[$index],
                        'temp' => $request->temp[$index],
                        'detalles_medicion_nom085_id' => $id_detalle
                    ]);

                    $contador ++;
                }

                return redirect()->back();
            }catch(Exception $e){
                Log::error("No se pudo guardar: ".$e->getMessage());
            }
            
        }catch(Exception $e){
            Log::error("----------------------------\nerror en la validación: ".$e->getMessage());
        }
    }

    private function calcular_marcado_sonda($diametro_int_c, $extencion_puerto){
        Log::info("Datos ingresados para el marcado de la sonda: ".$diametro_int_c." extención del puerto: ".$extencion_puerto);

        // Validación adicional de parámetros
        if (!is_numeric($diametro_int_c)) {
            throw new InvalidArgumentException("El diámetro debe ser numérico");
        }

        try{
            return [
                'marcado_1' => number_format((($diametro_int_c*(1/6))+$extencion_puerto),2),
                'marcado_2' => number_format((($diametro_int_c*(1/2))+$extencion_puerto),2),
                'marcado_3' => number_format((($diametro_int_c*(5/6))+$extencion_puerto),2)
            ];
        }catch(Exception $e){
            Log::error("Algo Salio mal en los calculos: ".$e->getMessage());
        }
    }

    private function calcular_promedios_campo(array $nox, array $co, array $o2, array $co2, array $temp){
        if (count($nox) !== count($co) || count($nox) !== count($o2) || count($nox) !== count($co2) || count($nox) !== count($temp)) {
            throw new InvalidArgumentException('Todos los arrays deben tener el mismo número de muestras');
        }

        $total_muestras = count($nox);
        $resultado = [];

        // Calcular para cada tipo
        foreach (['nox' => $nox, 'co' => $co, 'o2' => $o2, 'co2' => $co2, 'temp' => $temp] as $tipo => $valores) {
            $suma = 0;
            $validos = 0;
            
            foreach ($valores as $valor) {
                if (is_numeric($valor)) {
                    $suma += $valor;
                    $validos++;
                }
            }
            
            $resultado[$tipo] = $validos > 0 ? ($suma / $validos) : 0;
        }

        return $resultado;
    }

    private function calcular_estratificacion($valor_1, $valor_2, $valor_3){
        $concentracion_ppm_1 = $valor_1;
        $concentracion_ppm_2 = $valor_2;
        $concentracion_ppm_3 = $valor_3;

        $concentracion_promedio = number_format(($concentracion_ppm_1 + $concentracion_ppm_2 + $concentracion_ppm_3) / 3, 2);

        $estratificacion_1 = number_format(($concentracion_promedio == 0) ? 0 : abs(($concentracion_promedio - $concentracion_ppm_1) / $concentracion_promedio) * 100, 2);
        $estratificacion_2 = number_format(($concentracion_promedio == 0) ? 0 : abs(($concentracion_promedio - $concentracion_ppm_2) / $concentracion_promedio) * 100, 2);
        $estratificacion_3 = number_format(($concentracion_promedio == 0) ? 0 : abs(($concentracion_promedio - $concentracion_ppm_3) / $concentracion_promedio) * 100, 2);

        $ppm1 = number_format(abs($concentracion_promedio - $concentracion_ppm_1), 2);
        $ppm2 = number_format(abs($concentracion_promedio - $concentracion_ppm_2), 2);
        $ppm3 = number_format(abs($concentracion_promedio - $concentracion_ppm_3), 2);

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

    private function analizarValoresNox(array $nox): array{
        // 1. Filtrar y asegurar valores numéricos
        $noxFiltrado = array_filter($nox, 'is_numeric');
        
        // 2. Validar arreglo no vacío
        if (empty($noxFiltrado)) {
            return ['minimo' => 0, 'mediana' => 0, 'maximo' => 0];
        }

        // 3. Ordenar de menor a mayor (para mediana)
        sort($noxFiltrado);
        $count = count($noxFiltrado);
        $posicionQ1 = (int)(0.25 * count($noxFiltrado));

        // 4. Calcular valores
        return [
            'minimo' => $noxFiltrado[0], // Primer elemento
            'mediana' => $noxFiltrado[$posicionQ1],
            'maximo' => end($noxFiltrado) // Último elemento
        ];
    }

    private function determincacion_conclusiones($estrat_max, $ppm_max){
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

    public function d_p_e($puntos_finales = 12, $tipo_conducto = "Circular", $diametro_equ="10", $diametro, $conclusion) {
        if($puntos_finales == 12) {

            $resultados = [];

            if($tipo_conducto == "Circular"){

            }elseif($tipo_conducto == "Cuadrado" || $tipo_conducto == "Rectangular"){
                if($conclusion == 'Estratificada'){

                }
            }

            
            // return [
            //     'factores' => $this->factores_longuitud_kl
            // ];
        }
        
        return [
            "resultado" => "N/A"
        ];
    }
}