<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DocumentosController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;


Route::post('/login', [LoginController::class, 'login']);
Route::get('/documentos', [DocumentosController::class, 'index']);
Route::group(['middleware' => ['auth:app', 'jwt.auth']], function () {
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::get("/user/me", [UserController::class, 'me']);
    Route::post("/user", [UserController::class, 'store']);
    Route::get("/users", [UserController::class, 'index']);
    Route::get('/documentos-user', [DocumentosController::class, 'index']);
    Route::post('/alterar-senha', [LoginController::class, 'alterarSenha']);
    Route::post('/documentos', [DocumentosController::class, 'store']);
    Route::delete('/documentos/{id}', [DocumentosController::class, 'destroy']);
});


/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum'); */
