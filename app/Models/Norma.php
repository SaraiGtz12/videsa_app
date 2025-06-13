<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Norma extends Model
{
    public $timestamps = true;

    protected $table = 'normas'; 
    protected $primaryKey = 'id_norma';

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'id_estatus'
    ];
}
