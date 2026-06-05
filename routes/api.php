<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductoController;

Route::post('/google-login', 
    [AuthController::class, 'googleLogin']);

Route::post('/register',
    [AuthController::class, 'register']);

Route::post('/login',
    [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get(
    '/user',
    [AuthController::class, 'user']
);

Route::middleware('auth:sanctum')->post(
    '/logout',
    [AuthController::class, 'logout']
);
// TODOS PUEDEN VER
Route::get(
    '/productos',
    [ProductoController::class, 'index']
);

Route::get(
    '/productos/{producto}',
    [ProductoController::class, 'show']
);

// SOLO ADMIN
Route::middleware([
    'auth:sanctum',
    'admin'
])->group(function () {

    Route::post(
        '/productos',
        [ProductoController::class, 'store']
    );

    Route::put(
        '/productos/{producto}',
        [ProductoController::class, 'update']
    );

    Route::delete(
        '/productos/{producto}',
        [ProductoController::class, 'destroy']
    );
});