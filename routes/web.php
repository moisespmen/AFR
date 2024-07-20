<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
    Route::post('/login', [LoginController::class, 'login']);
});



Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
