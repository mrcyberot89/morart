<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('url'); // URL gambar dari ImgURL
            $table->string('thumbnail_url')->nullable(); // URL thumbnail
            $table->string('delete_url')->nullable(); // URL untuk delete
            $table->string('filename');
            $table->integer('filesize')->nullable(); // ukuran dalam bytes
            $table->string('caption')->nullable();
            $table->string('mime_type')->nullable();
            $table->timestamps();
            
            // Index untuk pencarian cepat
            $table->index('user_id');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('images');
    }
};
