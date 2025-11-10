<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RolDocumentoController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', function () {
    return view('login');
});

Route::get('/indexDocumentos', [DocumentoController::class, 'index']);
Route::get('/agregarDocumento', [DocumentoController::class, 'create']);
Route::post('/agregarDocumento', [DocumentoController::class, 'store']);
Route::get('/editarDocumento/{id}', [DocumentoController::class, 'edit']);
Route::patch('/editarDocumento/{id}/edit', [DocumentoController::class, 'update']);
Route::delete('/eliminarDocumento/{id}', [DocumentoController::class, 'destroy']);


Route::get('/acceso/{id}', [RolDocumentoController::class, 'acceso']);
Route::post('/acceso', [RolDocumentoController::class, 'store']);


Route::post('/login', [UsuarioController::class, 'login']);


Route::get('/dashboard', [DashboardController::class, 'create']);



