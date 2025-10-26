<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\DashboardController;


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
Route::put('/editarDocumento', [DocumentoController::class, 'update']);


Route::post('/login', [UsuarioController::class, 'login']);


Route::get('/dashboard', [DashboardController::class, 'create']);


