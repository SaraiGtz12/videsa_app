<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class eficiencia_conversion extends Model
{
    protected $table = 'eficiencia_conversion';
    protected $primaryKey = 'id_eficiencia';

    public $timestamps = true;

    protected $fillable = [
        'cdir',
        'cv',
        'effno',
        'id_informe'
    ];
}
