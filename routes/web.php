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

Route::get('/agregarDocumento', [DocumentoController::class, 'create']);


Route::post('/agregarDocumento', [DocumentoController::class, 'store']);


Route::post('/login', [UsuarioController::class, 'login']);


Route::get('/indexDocumentos', [DocumentoController::class, 'index']);


Route::get('/dashboard', [DashboardController::class, 'create']);