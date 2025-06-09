<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class medicion_nom085 extends Model
{
    protected $table = 'mediciones_nom085';
    
    protected $fillable = [
        'nox',
        'co_ppmv',
        'o2',
        'co2',
        'temp',
        'detalles_medicion_nom085_id'
    ];
}
