<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'user']);
Route::post("/register", [AuthController::class, 'register']);
Route::post("/token", [AuthController::class, 'token']);
