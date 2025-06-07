<?php

use App\Http\Controllers\FormsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Vistas_Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ServiceOrdersController;
use App\Http\Controllers\UsersController;

#--- Ruta Login ---#
Route::get('/', [Vistas_Controller::class, 'Login'])->name('login');
Route::post('/check_login', [LoginController::class, 'IniciarSesion'])->name('IniciarSesion');
Route::post('/logout', [LoginController::class, 'LogOut'])->name('LogOut');

#--- Ruta Administrador ---#
Route::get('/home', [Vistas_Controller::class, 'Home'])->name('Home');
Route::get('/registrar_cliente', [Vistas_Controller::class, 'RegistrarCliente'])->name('RegistrarCliente');
Route::get('/agregar_servicio', [Vistas_Controller::class, 'RegistrarServicio'])->name('AgregarServicio');
Route::get('/services_complete', [Vistas_Controller::class, 'VistaServiciosCompletados'])->name('ServiciosCompletados');
Route::get('/agregarUsuarios', [Vistas_Controller::class, 'VistaAgregarUsuarios'])->name('AgregarUsuarios');


//RUTAS PARA PLANTILLAS PDF
Route::get('generate085MG', [PdfController::class, 'generatePdf085MG']);
Route::get('generate085G', [PdfController::class, 'generatePdf085G']);
Route::get('generate085L', [PdfController::class, 'generatePdf085L']);
Route::post('generate085MG', [PdfController::class, 'generatePdf085MG']);
Route::post('generate085G', [PdfController::class, 'generatePdf085G']);

Route::get('/search',[Vistas_Controller::class, 'Buscar'])->name('Buscar');
Route::get('/servicios_registrados', [Vistas_Controller::class, 'VistaServiciosRegistrados'])->name('ServiciosRegistrados');

//Rutas para registros
Route::post('/register_order', [ServiceOrdersController::class, 'Registrarorden'])->name('Registrar_Orden');
Route::post('/register_user', [UsersController::class, 'RegistrarUsuarios'])->name('RegistrarUsuario');

//Rutas para la optención de datos
Route::get('/getMuestreadores', [FormsController::class, 'getMuestreadores']);
