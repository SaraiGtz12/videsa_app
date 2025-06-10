<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'razon_social',
        'rfc',
        'telefono',
        'correo',
        'creado_en',
        'actualizado_en',
    ];

    public function sucursales()
    {
        return $this->hasMany(Sucursal::class, 'id_cliente');
    }
}
