<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = "people";
    protected $primaryKey = 'idPerson';
    protected $fillable = ['name', 'lastName', 'secondLastName', 'userId'];
    public $timestamps = true;
}
