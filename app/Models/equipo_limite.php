<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class equipo_limite extends Model
{
    protected $table = 'equipos_limites';
    protected $primaryKey = 'id_equipo_limite';

    public $timestamps = true;

    protected $fillable = [
        'capacidad_termica_nominal',
        'id_tipo_combustible',
        'particulas_zvm',
        'particulas_zc',
        'particulas_rp',
        'bioxido_zvm',
        'bioxido_zc',
        'bioxido_rp',
        'oxido_zvm',
        'oxido_zc',
        'oxido_rp',
        'monoxido_zvm',
        'monoxido_zc',
        'monoxido_rp',
        'nuevo'
    ];
}
