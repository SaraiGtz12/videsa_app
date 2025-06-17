<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class determinacion_humedad extends Model
{
    protected $table = 'determinacion_humedad';
    protected $primaryKey = 'id_determinacion_humedad';

    public $timestamps = true;

    protected $fillable = [
        'peso_inicial',
        'peso_final',
        'ganancia',
        'id_informe'
    ];
}
