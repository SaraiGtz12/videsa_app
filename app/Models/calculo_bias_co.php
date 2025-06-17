<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class calculo_bias_co extends Model
{
    protected $table = 'calculo_bias_co';
    protected $primaryKey = 'id_calculo_co';

    public $timestamps = true;

    protected $fillable = [
        'baja_media',
        'respuesta_sistema',
        'tr_s',
        'flujo_lm',
        'respuesta_sistema_2',
        'id_informe',
    ];
}
