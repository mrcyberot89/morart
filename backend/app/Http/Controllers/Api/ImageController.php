<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ImgURLService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    protected $imgURLService;

    /**
     * Constructor: inject service
     */
    public function __construct(ImgURLService $imgURLService)
    {
        $this->imgURLService = $imgURLService;
    }

    /**
     * Upload gambar baru
     */
    public function upload(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // max 5MB
            'caption' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Upload ke ImgURL
            $result = $this->imgURLService->upload($request->file('image'));

            // Cek response dari ImgURL
            if ($result['code'] == 200) {
                // Simpan ke database MySQL
                $imageId = DB::table('images')->insertGetId([
                    'user_id' => auth()->id(), // jika pakai auth
                    'url' => $result['data']['url'],
                    'thumbnail_url' => $result['data']['thumbnail_url'] ?? null,
                    'delete_url' => $result['data']['delete'] ?? null,
                    'caption' => $request->caption,
                    'filename' => $request->file('image')->getClientOriginalName(),
                    'filesize' => $request->file('image')->getSize(),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                // Ambil data yang baru disimpan
                $image = DB::table('images')->find($imageId);

                return response()->json([
                    'success' => true,
                    'message' => 'Image uploaded successfully',
                    'data' => [
                        'id' => $image->id,
                        'url' => $image->url,
                        'thumbnail' => $image->thumbnail_url,
                        'caption' => $image->caption,
                        'delete_url' => $image->delete_url // opsional, untuk admin
                    ]
                ], 201);

            } else {
                // Upload gagal dari sisi ImgURL
                return response()->json([
                    'success' => false,
                    'message' => 'Upload to image host failed',
                    'error' => $result['msg'] ?? 'Unknown error'
                ], 500);
            }

        } catch (\Exception $e) {
            // Error lainnya
            return response()->json([
                'success' => false,
                'message' => 'Upload failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get semua gambar (list)
     */
    public function index(Request $request)
    {
        $images = DB::table('images')
            ->select('id', 'url', 'thumbnail_url', 'caption', 'created_at')
            ->where('user_id', auth()->id()) // jika pakai auth
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $images
        ]);
    }

    /**
     * Get single image by ID
     */
    public function show($id)
    {
        $image = DB::table('images')
            ->where('id', $id)
            ->where('user_id', auth()->id()) // jika pakai auth
            ->first();

        if (!$image) {
            return response()->json([
                'success' => false,
                'message' => 'Image not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $image
        ]);
    }

    /**
     * Delete image
     */
    public function destroy($id)
    {
        try {
            // Cari image
            $image = DB::table('images')
                ->where('id', $id)
                ->where('user_id', auth()->id())
                ->first();

            if (!$image) {
                return response()->json([
                    'success' => false,
                    'message' => 'Image not found'
                ], 404);
            }

            // Hapus dari ImgURL (jika ada delete_url)
            if ($image->delete_url) {
                $this->imgURLService->delete($image->delete_url);
            }

            // Hapus dari database
            DB::table('images')->where('id', $id)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Image deleted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Delete failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Upload multiple images
     */
    public function uploadMultiple(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'images' => 'required|array|max:5',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $uploadedImages = [];

        foreach ($request->file('images') as $index => $image) {
            try {
                $result = $this->imgURLService->upload($image);
                
                if ($result['code'] == 200) {
                    $imageId = DB::table('images')->insertGetId([
                        'user_id' => auth()->id(),
                        'url' => $result['data']['url'],
                        'thumbnail_url' => $result['data']['thumbnail_url'] ?? null,
                        'delete_url' => $result['data']['delete'] ?? null,
                        'filename' => $image->getClientOriginalName(),
                        'filesize' => $image->getSize(),
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);

                    $uploadedImages[] = [
                        'id' => $imageId,
                        'url' => $result['data']['url'],
                        'filename' => $image->getClientOriginalName()
                    ];
                }
            } catch (\Exception $e) {
                // Log error untuk gambar ini, lanjut ke gambar berikutnya
                \Log::error("Failed to upload image {$index}: " . $e->getMessage());
            }
        }

        return response()->json([
            'success' => true,
            'message' => count($uploadedImages) . ' images uploaded',
            'data' => $uploadedImages
        ]);
    }
}
