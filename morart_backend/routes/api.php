<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhotoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/photos', [PhotoController::class, 'store']);

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