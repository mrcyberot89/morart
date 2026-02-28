<?php
namespace App\Http\Controllers;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LukisanController;
use App\Http\Controllers\ImageController;
use illuminate\Support\Facades\Validator;

class GambarController  extends Controller

{
    public function store(Request $request)
    {
        // Validasi file
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // max 5MB
        ]);

        $result = Cloudinary::upload($request->file('image')->getRealPath());   
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }
        return response()->json([
            'success' => true,
            'message' => 'Gambar berhasil diunggah',
            'data' => $result
        ]);
    }
}