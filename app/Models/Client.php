<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = "clients";
    protected $primaryKey = 'idClient';
    protected $fillable = ['customerName'];
    public $timestamps = true;
}
