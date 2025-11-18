<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryStat extends Model
{
    protected $fillable = [
        'gallery_id',
        'likes_count',
        'shares_count',
        'downloads_count',
        'last_liked_at',
        'last_shared_at',
        'last_downloaded_at',
    ];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
