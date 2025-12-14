<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProcesoController;
use App\Http\Controllers\RolDocumentoController;
use App\Http\Controllers\TipoDocumentoController;


Route::get('/', [DashboardController::class, 'create']);

Route::get('/login', function () {
    return view('login');
});

Route::get('/usuarios', [UsuarioController::class, 'index']);


Route::get('/indexDocumentos', [DocumentoController::class, 'index']);
Route::get('/agregarDocumento', [DocumentoController::class, 'create']);
Route::post('/agregarDocumento', [DocumentoController::class, 'store']);
Route::get('/editarDocumento/{id}', [DocumentoController::class, 'edit']);
Route::patch('/editarDocumento/{id}/edit', [DocumentoController::class, 'update']);
Route::delete('/eliminarDocumento/{id}', [DocumentoController::class, 'destroy']);
Route::get('/traerDocumentos/{id}', [DocumentoController::class, 'select']);
Route::post('/descargarDocumento', [DocumentoController::class, 'download']);


Route::get('/acceso/{id}', [RolDocumentoController::class, 'acceso']);
Route::post('/acceso', [RolDocumentoController::class, 'store']);


Route::post('/agregarCategoria', [TipoDocumentoController::class, 'store']);
Route::patch('/editarCategoria', [TipoDocumentoController::class, 'update']);
Route::delete('/eliminarCategoria/{id}', [TipoDocumentoController::class, 'destroy']);


Route::post('/agregarProceso', [ProcesoController::class, 'store']);
Route::patch('/editarProceso', [ProcesoController::class, 'update']);
Route::delete('/eliminarProceso/{id}', [ProcesoController::class, 'destroy']);


Route::post('/login', [UsuarioController::class, 'login']);



Route::get('/dashboard', [DashboardController::class, 'create']);
Route::get('/', [DashboardController::class, 'create']);



