<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DocumentosController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
