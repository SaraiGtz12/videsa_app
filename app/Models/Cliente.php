<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'id_cliente';

    public $timestamps = false;

    protected $fillable = [
        'razon_social',
        'rfc',
        'telefono',
        'correo',
        'estatus'
    ];

    public function sucursales()
    {
        return $this->hasMany(Sucursal::class, 'id_cliente');
    }
}
