<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DocumentosController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/documentos', [DocumentosController::class, 'index']);
    Route::group(['middleware' => ['auth:app', 'jwt.auth']], function () {
        Route::get('/documentos-user', [DocumentosController::class, 'index']);
        Route::post('/alterar-senha', [LoginController::class, 'alterarSenha']);
        Route::post('/documentos', [DocumentosController::class, 'store']);
        Route::delete('/documentos/{id}', [DocumentosController::class, 'destroy']);
    });
});

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
