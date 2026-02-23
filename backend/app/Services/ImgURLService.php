<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Http\UploadedFile;
use Exception;

class ImgURLService
{
    protected $client;
    protected $uid;
    protected $token;
    protected $baseUrl = 'https://www.imgurl.org/api/v2/';

    /**
     * Constructor: siapkan client HTTP dan ambil credentials dari env
     */
    public function __construct()
    {
        // Ambil credentials dari environment variable
        $this->uid = env('IMGURL_UID');
        $this->token = env('IMGURL_TOKEN');

        // Cek apakah credentials tersedia
        if (!$this->uid || !$this->token) {
            throw new Exception('ImgURL credentials not set in environment variables');
        }

        // Siapkan HTTP client
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => 30, // timeout 30 detik
            'verify' => false, // untuk development, di production bisa true
        ]);
    }

    /**
     * Upload file ke ImgURL
     * 
     * @param UploadedFile $file File dari request
     * @return array Response dari API
     */
    public function upload(UploadedFile $file)
    {
        try {
            // Baca file content
            $fileContent = fopen($file->getPathname(), 'r');

            // Kirim request ke ImgURL
            $response = $this->client->post('upload', [
                'multipart' => [
                    [
                        'name' => 'uid',
                        'contents' => $this->uid
                    ],
                    [
                        'name' => 'token',
                        'contents' => $this->token
                    ],
                    [
                        'name' => 'file',
                        'contents' => $fileContent,
                        'filename' => $file->getClientOriginalName()
                    ]
                ]
            ]);

            // Tutup file handle
            if (is_resource($fileContent)) {
                fclose($fileContent);
            }

            // Decode response JSON
            $result = json_decode($response->getBody(), true);

            // Log untuk debugging
            \Log::info('ImgURL upload response:', $result);

            return $result;

        } catch (Exception $e) {
            // Log error
            \Log::error('ImgURL upload failed: ' . $e->getMessage());
            
            // Throw ulang dengan pesan yang lebih jelas
            throw new Exception('Failed to upload to ImgURL: ' . $e->getMessage());
        }
    }

    /**
     * Upload dari base64 string (opsional, untuk mobile apps)
     */
    public function uploadBase64($base64String, $filename = 'image.jpg')
    {
        try {
            $response = $this->client->post('upload', [
                'multipart' => [
                    [
                        'name' => 'uid',
                        'contents' => $this->uid
                    ],
                    [
                        'name' => 'token',
                        'contents' => $this->token
                    ],
                    [
                        'name' => 'file',
                        'contents' => base64_decode($base64String),
                        'filename' => $filename
                    ]
                ]
            ]);

            return json_decode($response->getBody(), true);

        } catch (Exception $e) {
            \Log::error('ImgURL base64 upload failed: ' . $e->getMessage());
            throw new Exception('Failed to upload base64 to ImgURL');
        }
    }

    /**
     * Hapus gambar dari ImgURL (menggunakan delete_url)
     */
    public function delete($deleteUrl)
    {
        try {
            $response = $this->client->get($deleteUrl);
            return json_decode($response->getBody(), true);
        } catch (Exception $e) {
            \Log::error('ImgURL delete failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Cek status API
     */
    public function checkStatus()
    {
        try {
            $response = $this->client->post('upload', [
                'multipart' => [
                    ['name' => 'uid', 'contents' => $this->uid],
                    ['name' => 'token', 'contents' => $this->token]
                ]
            ]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}