<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class dato_campo extends Model
{
    protected $table = 'datos_campo';
    protected $primaryKey = 'id_dato_campo';

    public $timestamps = true;

    protected $fillable = [
        'id_medicion',
        'nox',
        'co_ppmv',
        'o2',
        'co2',
        'temp',
        'id_informe'
    ];

}
