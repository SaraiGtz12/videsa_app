<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\detalles_medicion_nom085;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class nom085_Controller extends Controller
{
    public function registrar_nom085_mg(Request $request){
        try{
            $validatedData = $request->validate([
                "fecha_evaluacion" => "requiered|date",
                "empresa" => "required|integer",
                "equipo_evaluado" => "required|string",
                "marca" => "requiered|string",
                "combustible_utilizado" => "requiered|string",
                "anio" => "requiered|integer",
                "capacidad_termica" => "requiered|integer",
                "altura" => "requiered|integer",
                "presion_estatica" => "requiered|float",
                "presion_barometrica" => "requiered|float",
                "geometria_coductor" => "requiered|string",
                "diametro_i_d" => "requiered|float",
                "num_medicion_gases" => "requiered|integer",
                "diametro_equivalente" => "requiered|float",
                "largo_trasversal" => "nullable|integer",
                "ancho_transversal" => "nullable|integer",
                "num_puerto" => "requiered|integer",
                "extencion_puerto" => "requiered|float",
                "d_a" => "nullable|float",
                "d_b" => "nullable|float",
                "d_c" => "nullable|float",
                "num_d_a" => "nullable|float",
                "num_d_b" => "nullable|float",
                "num_d_c" => "nullable|float",
                "nox" => "requiered|float",
                "co" => "requiered|float",
                "o2" => "requiered|float",
                "co2" => "requiered|float",
                "temp" => "requiered|float",
                "nox.*" => "requiered|array",
                "co.*" => "requiered|array",
                "o2.*" => "requiered|array",
                "co2.*" => "requiered|array",
                "temp.*" => "requiered|array"
            ]);

            try{
                $modelData = [
                    'orden_trabajo_id' => null, // No está en la validación
                    'equipo_id' => $validatedData['empresa'] ?? null, // Asume que "empresa" es el ID del equipo
                    'combustible_utilizado' => $validatedData['combustible_utilizado'],
                    'capacidad_termica' => $validatedData['capacidad_termica'],
                    'altura_msnm' => $validatedData['altura'],
                    'precision_estatica' => $validatedData['presion_estatica'],
                    'anyo' => $validatedData['anio'],
                    'precion_barometrica' => $validatedData['presion_barometrica'],
                    'geometria_conducto' => $validatedData['geometria_coductor'],
                    'diametro_conducto' => $validatedData['diametro_i_d'],
                    'diametro_equivalente' => $validatedData['diametro_equivalente'],
                    'largo_transversal' => $validatedData['largo_trasversal'] ?? null, // nullable
                    'ancho_transversal' => $validatedData['ancho_transversal'],
                    'numero_puertos' => $validatedData['num_puerto'],
                    'distancia_a' => $validatedData['d_a'],
                    'distancia_b' => $validatedData['d_b'],
                    'distancia_c' => $validatedData['d_c'],
                    'extencion_puerto' => $validatedData['extencion_puerto'], // No está en la validación
                    'numero_diametro_a' => $validatedData['num_d_a'],
                    'numero_diametro_b' => $validatedData['num_d_b'],
                    'numero_diametro_c' => $validatedData['num_d_c'],
                    'puntos_seleccionados_medicion' => 0, // No está en la validación
                    'marcado_sonda_1' => 0, // No está en la validación
                    'marcado_sonda_2' => 0,
                    'marcado_sonda_3' => 0,
                    'concentracion_1' => 0,
                    'concentracion_2' => 0,
                    'concentracion_3' => 0,
                    'estratificacion_1' => 0,
                    'estratificacion_2' => 0,
                    'estratificacion_3' => 0,
                    'ppm_1' => 0,
                    'ppm_2' => 0,
                    'ppm_3' => 0,
                    'promedio_concentracion' => 0,
                    'max_estratificacion' => 0,
                    'max_ppm' => 0,
                ];

                // Insertar en la base de datos
                $registro = detalles_medicion_nom085::create($modelData);
                if($registro){
                    $id_registro = $registro->id;
                }else{
                    Log::error('No se pudo Guardar');
                }
            }catch(Exception $e){
                Log::error("Error al Guardar los datos ".$e->getMessage());
            }

        }catch(Exception $e){
            Log::erro("error en la validación: ".$e->getMessage());
        }
        return redirect()->back();
    }
}
