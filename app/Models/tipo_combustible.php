<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tipo_combustible extends Model
{
    protected $table = 'tipos_combustibles';
    protected $primaryKey = 'id_tipo_combustible';

    public $timestamps = true;

    protected $fillable = [
        'tipo'
    ];
}
