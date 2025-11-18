<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Like;
use App\Models\GalleryStat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleryLikeController extends Controller
{
    /**
     * Toggle like untuk sebuah gallery.
     * Route: POST /gallery/{gallery}/like
     */
    public function toggleLike(Request $request, Gallery $gallery)
    {
        $user = Auth::user();

        // Antisipasi kalau kepanggil tanpa login (walaupun route sudah pakai middleware auth)
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Anda harus login untuk menyukai foto.',
            ], 401);
        }

        // Cek apakah user sudah pernah like gallery ini
        $existingLike = Like::where('gallery_id', $gallery->id)
            ->where('user_id', $user->id)
            ->first();

        // Ambil / buat record statistik untuk gallery ini
        $stats = GalleryStat::firstOrCreate(
            ['gallery_id' => $gallery->id],
            [] // field lain pakai default migration
        );

        if ($existingLike) {
            // ===================
            // UNLIKE
            // ===================
            $existingLike->delete();
            $liked = false;

            // Kurangi likes_count di stats, jangan sampai minus
            if ($stats->likes_count > 0) {
                $stats->decrement('likes_count');
            }
        } else {
            // ===================
            // LIKE BARU
            // ===================
            Like::create([
                'gallery_id' => $gallery->id,
                'user_id'    => $user->id,
            ]);
            $liked = true;

            // Tambahkan likes_count + update waktu terakhir like
            $stats->increment('likes_count');
            $stats->last_liked_at = now();
        }

        $stats->save();

        // Ambil jumlah like terbaru dari stats
        $likesCount = $stats->likes_count;

        return response()->json([
            'success'     => true,
            'liked'       => $liked,        // true = baru like, false = batal like
            'likes_count' => $likesCount,   // total like terbaru
        ]);
    }
}
