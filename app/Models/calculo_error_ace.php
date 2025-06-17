<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class calculo_error_ace extends Model
{
    protected $table = 'calculo_error_ace';
    protected $primaryKey = 'id_calculo_error';

    public $timestamps = true;

    protected $fillable = [
        'o2',
        'co',
        'nox',
        'id_informe'
    ];
}
