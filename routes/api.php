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
Route::apiResource(
    'productos',
    ProductoController::class
);