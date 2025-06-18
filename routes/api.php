<?php

use App\Http\Controllers\Api\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ServicioController;
use App\Http\Controllers\Api\FormularioController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [LoginController::class, 'login_api'])->name('login_api');





Route::get('/servicios', [ServicioController::class, 'obtenerServicios']);
Route::get('/formulario-datos', [FormularioController::class, 'obtenerFormulario']);