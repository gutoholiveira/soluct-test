<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function(){
    Route::prefix('auth')->controller(AuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('logout', 'logout')->middleware('auth:sanctum');
    });
    
    Route::prefix('users')->controller(UserController::class)->group(function () {
        Route::post('', 'store');
    });
    
    Route::middleware('auth:sanctum')->group(function(){
        Route::prefix('users')->controller(UserController::class)->group(function () {
            Route::get('', 'index');
            Route::get('/{user}', 'show');
            Route::put('/{user}', 'update');
            Route::delete('/{user}', 'destroy');
        });
        
        Route::prefix('products')->controller(ProductController::class)->group(function(){
            Route::get('', 'index');
            Route::get('/{product}', 'show');
            Route::put('/{product}', 'update');
            Route::delete('/{product}', 'destroy');
            Route::get('/manual/sync', 'sync');
        });
    });
});