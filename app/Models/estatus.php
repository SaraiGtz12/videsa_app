<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class estatus extends Model
{
    protected $table = 'estatus';
    protected $primaryKey = 'id_estatus';

    public $timestamps = true;

    protected $fillable = [
        'estatus'
    ];
}
