<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\detalles_medicion_nom085;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

class nom085_Controller extends Controller
{
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
                "num_medicion_gases" => "required|integer|min:1",
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
            return redirect()->back();
            
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
