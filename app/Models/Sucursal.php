<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = 'sucursales';
    protected $primaryKey = 'id_sucursal'; 

    public $timestamps = true;

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
        'id_estatus'
    ];

}
