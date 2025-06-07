<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = "addresses";
    protected $primaryKey = 'idAddress';
    protected $fillable = ['street', 'neighborhood', 'city', 'state', 'references', 'clientId'];
    public $timestamps = true;
}
