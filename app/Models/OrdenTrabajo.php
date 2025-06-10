<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdenTrabajo extends Model
{
    protected $table = 'ordenes_trabajo';  
    protected $primaryKey = 'id';       
    public $timestamps = false;          

    protected $fillable = [
        'codigo',
        'usuario_asignado',
        'usuario_creador',
        'id_norma',
        'id_cliente',
        'id_sucursal',
        'fecha_evaluacion',
        'fecha_reconocimiento',
        'estado',
        'creado_en',
        'actualizado_en',
    ];

}
