<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GalleryLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleryLikeController extends Controller
{
    public function toggleLike(Gallery $gallery)
    {
        $user = Auth::user();
        $ipAddress = request()->ip();
        
        // Check for existing like from this IP or user
        $existingLike = $gallery->likes()
            ->where('ip_address', $ipAddress)
            ->when($user, function($query) use ($user) {
                return $query->orWhere('user_id', $user->id);
            })
            ->first();

        if ($existingLike) {
            // Jika sudah ada like, hapus (unlike)
            $existingLike->delete();
            $liked = false;
        } else {
            // Jika belum ada like, tambahkan
            $gallery->likes()->create([
                'user_id' => $user ? $user->id : null,
                'ip_address' => $ipAddress,
                'user_agent' => request()->userAgent()
            ]);
            $liked = true;
        }

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'likes_count' => $gallery->likes()->count()
        ]);
    }
}
