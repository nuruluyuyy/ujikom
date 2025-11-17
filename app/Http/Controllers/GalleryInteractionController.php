<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\GalleryLike;

class GalleryInteractionController extends Controller
{
    public function getLikes($id)
    {
        $gallery = Gallery::findOrFail($id);
        $ipAddress = request()->ip();
        $isLiked = $gallery->isLikedBy($ipAddress);

        return response()->json([
            'likes_count' => $gallery->likes()->count(),
            'is_liked' => $isLiked
        ]);
    }

    public function like($id)
    {
        $gallery = Gallery::findOrFail($id);
        $ipAddress = request()->ip();

        // Check if already liked
        $existingLike = GalleryLike::where('gallery_id', $id)
            ->where('ip_address', $ipAddress)
            ->first();

        if ($existingLike) {
            // Unlike
            $existingLike->delete();
            $liked = false;
        } else {
            // Like
            GalleryLike::create([
                'gallery_id' => $id,
                'ip_address' => $ipAddress,
                'user_agent' => request()->userAgent()
            ]);
            $liked = true;
        }

        // Refresh gallery to get updated count
        $gallery->refresh();

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'likes_count' => $gallery->likes()->count(),
            'is_liked' => $gallery->isLikedBy($ipAddress)
        ]);
    }
}
