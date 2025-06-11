<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class medicion_nom085 extends Model
{
    protected $table = 'medicion_nom85';
    
    
    protected $fillable = [
        'nox',
        'co_ppmv',
        'o2',
        'co2',
        'temperatura',
        'id_medicion_detalle'
    ];
}
