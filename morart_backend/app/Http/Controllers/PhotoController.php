<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cloudinary\Api\Upload\UploadApi;

class PhotoController extends Controller
{


    public function store(Request $request)
    {
        $request->validate(['image' => 'required|image|max:2048']);

        $cloudinary = new UploadApi();
        $result = $cloudinary->upload($request->file('image')->getRealPath(), [
            'folder' => 'products',
            'public_id' => time() . '_' . $request->file('image')->getClientOriginalName(),
        ]);

        return response()->json(['url' => $result['secure_url']]);
    }
}
