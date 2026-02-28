<?php

namespace App\Models;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    //
    use HasFactory;
    protected $table = "images";
    protected $primaryKey = "id";
    protected $fillable = ["id", "filename", "created_at", "updated_at"];

    public function uploadImageWithHelper(UploadedFile $file)
    {
        try {
            $result = Cloudinary::upload($file->getRealPath(), [
                'folder' => 'products',
                'public_id' => time() . '_' . $file->getClientOriginalName(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);

        }
    }
}
