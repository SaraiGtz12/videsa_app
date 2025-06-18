<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ServicioController;
use App\Http\Controllers\Api\FormularioController;


Route::post('/login', [LoginController::class, 'IniciarSesion'])->name('login_api');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/logout', [LoginController::class, 'LogOut'])->name('logout_api');
    Route::get('/servicios', [ServicioController::class, 'obtenerServicios']);
    Route::get('/formulario-datos', [FormularioController::class, 'obtenerFormulario']);
});

