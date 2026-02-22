<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Prompts\Table;

class Lukisan extends Model
{
    //
    use HasFactory;
    protected $table = "lukisans";
    protected $primaryKey = "id";
    protected $fillable = ["id", "gambar", "nama", "lebar", "tinggi", "harga"];
}
