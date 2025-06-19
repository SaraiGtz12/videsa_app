<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class datos_servicio extends Model
{
    protected $table = 'datos_servicios';
    protected $primaryKey = 'id_datos_servicio';

    public $timestamps = true;

    protected $fillable = [
        'descripcion',
        'id_norma',
        'id_orden_servicio',
        'id_estatus'
    ];
}
