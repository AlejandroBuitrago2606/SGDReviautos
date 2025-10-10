<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', function () {
    return view('login');
});

Route::get('/agregarDocumento', function () {
    return view('agregarDocumento');
});

Route::post('/login', [UsuarioController::class, 'login']);
