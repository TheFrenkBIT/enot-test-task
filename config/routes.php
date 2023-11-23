<?php
use App\Router\Route;
use App\Controllers\AuthController;
use App\Controllers\RegisterController;
use App\Controllers\AdminController;
return [
    Route::get('/login', [AuthController::class, 'login']),
    Route::post('/login', [AuthController::class, 'authUser']),
    Route::get('/register', [RegisterController::class, 'register']),
    Route::post('/register', [RegisterController::class, 'saveUser']),
    Route::get('/save-rates', [AdminController::class, 'saveRates']),
    Route::get('/update-rates', [AdminController::class, 'updateRates']),
    Route::get('/admin', [AdminController::class, 'getRates']),
];