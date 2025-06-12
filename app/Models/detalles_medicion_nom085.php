<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class detalles_medicion_nom085 extends Model
{
    protected $table = 'detalles_mediciones_nom085';

    protected $fillable = [
        'orden_trabajo_id',
        'equipo_id',
        'combustible_utilizado',
        'capacidad_termica',
        'altura_msnm',
        'precision_estatica',
        'anyo',
        'presion_barometrica',
        'geometria_conducto',
        'diametro_conducto',
        'diametro_equivalente',
        'largo_transversal',
        'ancho_transversal',
        'numero_puertos',
        'distancia_a',
        'distancia_b',
        'distancia_c',
        'extencion_puerto',
        'numero_diametro_a',
        'numero_diametro_b',
        'numero_diametro_c',
        'puntos_seleccionados_medicion',
        'marcado_sonda_1',
        'marcado_sonda_2',
        'marcado_sonda_3',
        'concentracion_1',
        'concentracion_2',
        'concentracion_3',
        'estratificacion_1',
        'estratificacion_2',
        'estratificacion_3',
        'ppm_1',
        'ppm_2',
        'ppm_3',
        'promedio_concentracion',
        'max_estratificacion',
        'max_ppm', 
        'conclusion'
    ];
}
