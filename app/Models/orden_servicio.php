<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orden_servicio extends Model
{
    protected $table = 'ordenes_servicios';
    protected $primaryKey = 'id_orden_servicio';

    public $timestamps = true;

    protected $fillable = [
        'id_cliente',
        'id_sucursal',
        'fecha_muestreo',
        'muestreador_asignado',
        'numero_servicio',
        'id_estatus'
    ];
}
