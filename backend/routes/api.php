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

Route::get('/test-env', function() {
    return response()->json([
        'imgurl_uid' => env('IMGURL_UID') ? 'ADA' : 'TIDAK ADA',
        'imgurl_token' => env('IMGURL_TOKEN') ? 'ADA' : 'TIDAK ADA',
        'app_env' => env('APP_ENV')
    ]);
});