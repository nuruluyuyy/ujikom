<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Category;
use App\Models\Photo;
use App\Models\ImageLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::withCount('likes')->latest()->paginate(12);
        return view('guest.gallery', compact('galleries'));
    }

    /**
     * Like or unlike a gallery image.
     */
    public function like($id)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu untuk memberikan like.'
            ], 401);
        }

        $gallery = Gallery::findOrFail($id);
        $user = Auth::user();

        // Cek apakah user sudah like
        $existingLike = ImageLike::where('gallery_id', $gallery->id)
                                ->where('user_id', $user->id)
                                ->first();

        if ($existingLike) {
            // Jika sudah like, hapus like
            $existingLike->delete();
            $liked = false;
        } else {
            // Jika belum like, tambahkan like
            ImageLike::create([
                'gallery_id' => $gallery->id,
                'user_id' => $user->id
            ]);
            $liked = true;
        }

        // Hitung total like terbaru
        $totalLikes = $gallery->likes()->count();

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'total_likes' => $totalLikes
        ]);
    }

    /**
     * Show share dialog for a gallery image.
     */
    public function share($id)
    {
        $gallery = Gallery::findOrFail($id);
        $shareUrl = route('gallery.show', $gallery->id);
        $imageUrl = asset('storage/' . $gallery->image);
        
        return view('guest.share', compact('gallery', 'shareUrl', 'imageUrl'));
    }

    /**
     * Download the specified gallery image.
     */
    public function download($id)
    {
        try {
            $gallery = Gallery::findOrFail($id);
            
            // Pastikan file ada di storage
            if (!Storage::disk('public')->exists($gallery->image)) {
                return back()->with('error', 'File tidak ditemukan');
            }

            // Dapatkan path lengkap ke file
            $filePath = storage_path('app/public/' . $gallery->image);
            
            // Dapatkan ekstensi file
            $extension = pathinfo($gallery->image, PATHINFO_EXTENSION);
            $fileName = Str::slug($gallery->title) . '.' . $extension;

            // Log download
            Log::info('File downloaded: ' . $gallery->image . ' by user: ' . (Auth::check() ? Auth::id() : 'guest'));

            // Return response download
            return response()->download($filePath, $fileName, [
                'Content-Type' => 'image/' . $extension,
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            ]);
        } catch (\Exception $e) {
            Log::error('Download error: ' . $e->getMessage());
            return back()->with('error', 'Gagal mengunduh file: ' . $e->getMessage());
        }
    }

    /**
     * Get likes count for multiple images
     */
    public function getLikes(Request $request)
    {
        $imageIds = $request->input('image_ids', []);
        
        if (empty($imageIds)) {
            return response()->json([]);
        }

        $likes = ImageLike::whereIn('gallery_id', $imageIds)
                         ->selectRaw('gallery_id, count(*) as count')
                         ->groupBy('gallery_id')
                         ->pluck('count', 'gallery_id');

        return response()->json($likes);
    }

    /**
     * Check if current user has liked the images
     */
    public function checkUserLikes(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([]);
        }

        $imageIds = $request->input('image_ids', []);
        
        if (empty($imageIds)) {
            return response()->json([]);
        }

        $userLikes = ImageLike::where('user_id', Auth::id())
                             ->whereIn('gallery_id', $imageIds)
                             ->pluck('gallery_id')
                             ->toArray();

        return response()->json($userLikes);
    }
}