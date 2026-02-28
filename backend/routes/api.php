<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LukisanController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\GambarController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/lukisan', [LukisanController::class, 'index']);
Route::post('/lukisan/add_lukisan', [LukisanController::class, 'store']);
Route::get('/lukisan/{id}', [LukisanController::class, 'show']);
Route::put('/lukisan/{id}', [LukisanController::class, 'update']);
Route::delete('/lukisan/{id}', [LukisanController::class, 'destroy']);



// Public routes (tanpa auth)
Route::get('/images/public', [ImageController::class, 'index']);
Route::post('/images/add_images', [ImageController::class, 'store']);

// Protected routes (dengan auth)
// Route::middleware('auth:sanctum')->group(function () {
//     // Image upload
//     Route::post('/images/upload', [ImageController::class, 'upload']);
//     Route::post('/images/upload-multiple', [ImageController::class, 'uploadMultiple']);

//     // Image management
//     Route::get('/images', [ImageController::class, 'index']); // list my images
//     Route::get('/images/{id}', [ImageController::class, 'show']);
//     Route::delete('/images/{id}', [ImageController::class, 'destroy']);
// });

// Test route untuk cek environment (opsional)
Route::get('/test-env', function () {
    return response()->json([
        'imgurl_uid' => env('IMGURL_UID') ? 'TERSET' : 'TIDAK SET',
        'imgurl_token' => env('IMGURL_TOKEN') ? 'TERSET' : 'TIDAK SET',
        'app_env' => app()->environment()
    ]);
});


Route::post('/upload/facade', [ImageController::class, 'uploadWithFacade']);
Route::post('/upload/store', [GambarController::class, 'store']);


Route::get('/test-cloudinary', function() {
    try {
        // Cek apakah package terload
        if (!class_exists('CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary')) {
            return "❌ Cloudinary Facade tidak ditemukan. Install ulang package.";
        }
        
        // Cek konfigurasi
        $cloudinaryUrl = env('CLOUDINARY_URL');
        if (!$cloudinaryUrl) {
            return "❌ CLOUDINARY_URL tidak ada di .env";
        }
        
        return "✅ Konfigurasi OK. CLOUDINARY_URL: " . substr($cloudinaryUrl, 0, 20) . "...";
        
    } catch (\Exception $e) {
        return "❌ Error: " . $e->getMessage();
    }
});