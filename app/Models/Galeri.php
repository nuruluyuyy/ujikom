<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeris';

    protected $fillable = [
        'kategori_id',
        'judul',
        'deskripsi',
        'status',
    ];

    // Relasi ke kategori (many-to-one)
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    // Relasi ke foto (one-to-many)
    public function fotos()
    {
        return $this->hasMany(Foto::class);
    }
}
