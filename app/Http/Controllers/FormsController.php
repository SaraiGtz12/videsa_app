<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class FormsController extends Controller
{
    public function getMuestreadores(){
        $muestreadores = User::join('roles', 'roles.idRol', '=', 'users.rolId')
        ->join('people', 'people.userId', '=', 'users.idUser')
        ->select('people.*','users.idUser')
        ->where('roles.rol', '=', 'Muestreador')
        ->get();

        return response()->json($muestreadores);
    }
}
