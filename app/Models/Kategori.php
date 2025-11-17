<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'kategoris';

    // Kolom yang boleh diisi
    protected $fillable = [
        'nama_kategori',
        'status',
    ];

    // Relasi: satu kategori punya banyak galeri
    public function galeris()
    {
        return $this->hasMany(Galeri::class);
    }
}
