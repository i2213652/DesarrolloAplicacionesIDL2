<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AlumnoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::GET('/alumnos/listar', [AlumnoController::class, 'listar']);
Route::POST('/alumnos/verificar', [AlumnoController::class, 'verificar']);
Route::POST('/alumnos/guardar', [AlumnoController::class, 'guardar']);
Route::PUT('/alumnos/actualizar/{id}', [AlumnoController::class, 'actualizar']);
Route::DELETE('/alumnos/eliminar/{id}', [AlumnoController::class, 'eliminar']);
