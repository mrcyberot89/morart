<?php

namespace App\Http\Controllers;

use App\Models\Images;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class ImageController extends Controller
{
    /**
     * Upload gambar ke Cloudinary (menggunakan Facade)
     */
    public function uploadWithFacade(Request $request)
    {
        // Validasi file
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // max 5MB
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Upload ke Cloudinary menggunakan Facade
            $uploadedFile = Cloudinary::upload(
                $request->file('image')->getRealPath(),
                [
                    'folder' => 'products', // folder di Cloudinary
                    'public_id' => time() . '_' . $request->file('image')->getClientOriginalName(),
                ]
            );

            // Ambil URL secure (HTTPS)
            $imageUrl = $uploadedFile->getSecurePath();
            $publicId = $uploadedFile->getPublicId();

            return response()->json([
                'success' => true,
                'message' => 'Gambar berhasil diupload ke Cloudinary',
                'data' => [
                    'url' => $imageUrl,
                    'public_id' => $publicId,
                    'size' => $uploadedFile->getSize(),
                    'format' => $uploadedFile->getExtension(),
                    'original_name' => $request->file('image')->getClientOriginalName()
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // max 5MB
        ]);

        $clouImage = Cloudinary::uploadApi()->upload(
            $request->file('image')->getRealPath(), 
            [
            'folder' => 'products',
            'public_id' => time() . '_' . $request->file('image')->getClientOriginalName(),
            ]
        );
        // Images::create([
        //     'filename' => $uploadedFile,
        // ]);

        // $Images = Images::latest()->first(); // Get the latest created image
        // $Images->refresh(); // Refresh model to get updated data    

    return response()->json([
            'message' => 'Gambar berhasil diupload ke Cloudinary',
            
        ]);
    }
}
