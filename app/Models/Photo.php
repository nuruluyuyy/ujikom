<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_path',
        'gallery_id',
        'is_cover'
    ];

    protected $casts = [
        'is_cover' => 'boolean',
    ];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image_path) {
            return asset('images/default-photo.jpg');
        }
        
        if (strpos($this->image_path, 'http') === 0) {
            return $this->image_path;
        }
        
        return asset('storage/' . $this->image_path);
    }
}