<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class informe extends Model
{
    protected $table = 'datos_campo';
    public $timestamps = true;
    protected $primaryKey = 'id_informe';

    protected $fillable = [
        'numero_informe',
        'id_norma',
        'id_orden_servicio',
        'combustible_utilizado',
        'anio',
        'equipo_evaluado',
        'marca_modelo',
        'cpacidad_termica_nominal',
        'altura_nivel_mar',
        'precion_estatica',
        'geometria_conducto',
        'diametro_int',
        'diametro_eq',
        'largo_transversal',
        'ancho_transversal',
        'numero_puertos',
        'distancia_a',
        'distancia_b',
        'distancia_c',
        'extencion_puerto',
        'num_diametros_a',
        'num_diametros_b',
        'num_diametros_c',
        'presion_barometrica_1',
        'presion_barometrica_2',
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
        'id_zona_geografica',
    ];
}
