<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'id_cliente';

    public $timestamps = true;

    protected $fillable = [
        'razon_social',
        'rfc',
        'telefono',
        'correo',
        'id_estatus'
    ];

    public function sucursales()
    {
        return $this->hasMany(Sucursal::class, 'id_cliente');
    }
}
