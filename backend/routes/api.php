<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LukisanController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/lukisan', [LukisanController::class, 'index']);
Route::post('/lukisan/add_lukisan', [LukisanController::class, 'store']);
Route::get('/lukisan/{id}', [LukisanController::class, 'show']);
Route::put('/lukisan/{id}', [LukisanController::class, 'update']);
Route::delete('/lukisan/{id}', [LukisanController::class, 'destroy']);
