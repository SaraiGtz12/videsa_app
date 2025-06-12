<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class zona_geografica extends Model
{
    protected $table = 'zonas_geograficas';
    protected $primaryKey = 'id_zona_geografica'; 

    public $timestamps = true;

    protected $fillable = [
        'lugar',
        'codigo'
    ];
}
