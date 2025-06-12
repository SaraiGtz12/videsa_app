<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Norma extends Model
{
    public $timestamps = true;

    protected $table = 'normas'; 

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'activa'
    ];
}
