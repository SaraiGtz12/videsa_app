<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{
    protected $table = "serviceOrders";
    protected $primaryKey = 'idServiceOrder';
    protected $fillable = ['serviceOrder', 'responsible', 'phoneNumber', 'AssignedTo', 'userId', 'addressId'];
    public $timestamps = true;
}
