<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $table = 'fotos';

    protected $fillable = [
        'galeri_id',
        'path',
        'status',
    ];

    // Relasi ke galeri (many-to-one)
    public function galeri()
    {
        return $this->belongsTo(Galeri::class);
    }
}
