<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cloudinary\Api\Upload\UploadApi;
use App\Models\Photo;

class PhotoController extends Controller
{


    public function store(Request $request)
    {
        //validasi input gambar
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|max:2048'
        ]);

        $cloudinary = new UploadApi();
        $result = $cloudinary->upload($request->file('image')->getRealPath(), [
            'folder' => 'products',
            'public_id' => time() . '_' . $request->file('image')->getClientOriginalName(),
        ]);

        // Simpan URL gambar ke database jika diperlukan
        Photo::create([
            'title' => $request->title,
            'image_url' => $result['secure_url'],
            'image_public_id' => $result['public_id']
        ]);

        // Kembalikan response JSON dengan URL gambar yang diunggah
        return response()->json([
            'success' => true,
            'message' => 'Gambar berhasil diunggah',
            'data' => [
                'title' => $request->title,
                'image_url' => $result['secure_url'],
                'image_public_id' => $result['public_id']
            ]
        ]);
    }

    public function index(){

        $photos = Photo::all();
        return response()->json([
            'success' => true,
            'data' => $photos
        ]);
    }
}
