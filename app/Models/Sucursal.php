<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = 'sucursales';
    protected $primaryKey = 'id'; 

    public $timestamps = false;

    protected $fillable = [
        'id_cliente',
        'nombre',
        'codigo',
        'telefono',
        'calle',
        'numero',
        'colonia',
        'ciudad',
        'estado',
        'codigo_postal',
        'estatus'
    ];

}
