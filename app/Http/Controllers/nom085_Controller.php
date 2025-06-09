<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class nom085_Controller extends Controller
{
    public function registrar_nom085_mg(Request $request){
        Log::info('La petición llego');
        return redirect()->back();
    }
}
