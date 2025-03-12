<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ApiAuthMiddleware;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ContactController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::post('/users', [\App\Http\Controllers\UserController::class, 'register']);
Route::post('/users/login', [\App\Http\Controllers\UserController::class, 'login']);
Route::apiResource('address', AddressController::class);
Route::apiResource('contacts', ContactController::class);

Route::middleware(\App\Http\Middleware\ApiAuthMiddleware::class)->group(function () {
    Route::get('/users/current', [\App\Http\Controllers\UserController::class, 'get']);
    Route::patch('/users/current', [\App\Http\Controllers\UserController::class, 'update']);
    Route::delete('/users/logout', [\App\Http\Controllers\UserController::class, 'logout']);

    
});
