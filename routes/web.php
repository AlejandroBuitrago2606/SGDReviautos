<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DocumentoController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', function () {
    return view('login');
});

Route::get('/agregarDocumento', [DocumentoController::class, 'viewAgregarDoc']);

Route::post('/login', [UsuarioController::class, 'login']);
