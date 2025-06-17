<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class distribucion_puntos extends Model
{
    protected $table = 'distribucion_puntos';
    protected $primaryKey = 'id_distribucion_punto';

    public $timestamps = true;

    protected $fillable = [
        'puerto',
        'punto',
        'factor_kl',
        'distancias',
        'ap',
        'id_informe'
    ];
}
