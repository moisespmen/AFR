<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::group(['middleware' => ['auth:app', 'jwt.auth']], function () {
        Route::post('/alterar-senha', [LoginController::class, 'alterarSenha']);
    });
});

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
