<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProcesoController;
use App\Http\Controllers\RolDocumentoController;
use App\Http\Controllers\TipoDocumentoController;


Route::get('/', [UsuarioController::class, 'viewLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [UsuarioController::class, 'login']);
Route::post('/logout', [UsuarioController::class, 'logout'])->name('logout');

Route::post('/agregarUsuario', [UsuarioController::class, 'store']);

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/usuarios', [UsuarioController::class, 'index']); /**/
    Route::get('/agregarDocumento', [DocumentoController::class, 'create']); /**/
    Route::get('/editarDocumento/{id}', [DocumentoController::class, 'edit']);  /**/
    Route::get('/acceso/{id}', [RolDocumentoController::class, 'acceso']);  /**/

});


Route::middleware('auth')->group(function () {

    Route::patch('/editarUsuario', [UsuarioController::class, 'update']);
    Route::delete('/eliminarUsuario/{id}', [UsuarioController::class, 'destroy']);


    Route::get('/indexDocumentos', [DocumentoController::class, 'index']);

    Route::post('/agregarDocumento', [DocumentoController::class, 'store']);
    Route::patch('/editarDocumento/{id}/edit', [DocumentoController::class, 'update']);
    Route::delete('/eliminarDocumento/{id}', [DocumentoController::class, 'destroy']);
    Route::get('/traerDocumentos/{id}', [DocumentoController::class, 'select']);
    Route::post('/descargarDocumento', [DocumentoController::class, 'download']);


    Route::post('/acceso', [RolDocumentoController::class, 'store']);


    Route::post('/agregarCategoria', [TipoDocumentoController::class, 'store']);
    Route::patch('/editarCategoria', [TipoDocumentoController::class, 'update']);
    Route::delete('/eliminarCategoria/{id}', [TipoDocumentoController::class, 'destroy']);


    Route::post('/agregarProceso', [ProcesoController::class, 'store']);
    Route::patch('/editarProceso', [ProcesoController::class, 'update']);
    Route::delete('/eliminarProceso/{id}', [ProcesoController::class, 'destroy']);


    Route::get('/dashboard', [DashboardController::class, 'index']);
});
