<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuestGalleryController extends Controller
{
    /**
     * Halaman list galeri untuk tamu.
     */
    public function index()
    {
        // Ambil semua kategori + relasi galeri
        $categories = Category::with('galleries')->get();

        // Ambil semua galeri terbaru + relasi kategori dan likes
        $galleries = Gallery::with(['category', 'likes'])->latest()->get();

        // User login (kalau ada)
        $user = auth()->user();

        // Set likes_count dan is_liked per gallery
        $galleries->each(function ($gallery) use ($user) {
            // Hitung jumlah like
            $gallery->likes_count = $gallery->likes->count();

            // Cek apakah user ini sudah like
            if ($user) {
                $gallery->is_liked = $gallery->likes()
                    ->where('user_id', $user->id)
                    ->exists();
            } else {
                $gallery->is_liked = false;
            }
        });

        // Jika tidak ada galleries, set empty collection
        if ($galleries->isEmpty()) {
            $galleries = collect([]);
        }

        // Get user IP (kalau suatu saat mau dipakai)
        $userIp = request()->ip();

        // Kirim ke view
        return view('guest.gallery', compact('categories', 'galleries', 'userIp'));
    }

    /**
     * Halaman detail 1 galeri.
     */
    public function show(Gallery $gallery)
    {
        $gallery->load(['category', 'likes']);
        $gallery->likes_count = $gallery->likes->count();

        $userIp = request()->ip();
        $user = auth()->user();

        // Pakai isLikedBy kalau kamu punya, kalau tidak, bisa pakai where user_id
        if (method_exists($gallery, 'isLikedBy')) {
            $gallery->is_liked = $gallery->isLikedBy($userIp);
        } elseif ($user) {
            $gallery->is_liked = $gallery->likes()
                ->where('user_id', $user->id)
                ->exists();
        } else {
            $gallery->is_liked = false;
        }

        $relatedGalleries = Gallery::where('category_id', $gallery->category_id)
            ->where('id', '!=', $gallery->id)
            ->with('category')
            ->latest()
            ->take(4)
            ->get();

        return view('guest.gallery-detail', compact('gallery', 'relatedGalleries', 'userIp'));
    }

    /**
     * LIKE galeri – versi login (route dilindungi middleware auth).
     * Dipanggil dari AJAX di view (kalau user belum login, dialihkan ke login oleh blade).
     */
    public function like(Gallery $gallery, Request $request)
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda harus login terlebih dahulu.'
            ], 401);
        }

        $user = auth()->user();

        // Pastikan di model Gallery ada relasi likes() dan tabel likes punya user_id
        $existing = $gallery->likes()->where('user_id', $user->id)->first();

        if ($existing) {
            // kalau sudah like, maka un-like
            $existing->delete();
            $liked = false;
        } else {
            // kalau belum, buat like baru
            $gallery->likes()->create([
                'user_id' => $user->id,
            ]);
            $liked = true;
        }

        $likesCount = $gallery->likes()->count();

        return response()->json([
            'success'     => true,
            'liked'       => $liked,
            'likes_count' => $likesCount,
        ]);
    }

    /**
     * DOWNLOAD foto galeri.
     */
    public function download(Gallery $gallery)
    {
        $filePath = $gallery->image;

        if (!$filePath || !Storage::disk('public')->exists($filePath)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        $downloadName = ($gallery->title ? str_replace(' ', '_', $gallery->title) : 'foto_galeri')
            . '.' . pathinfo($filePath, PATHINFO_EXTENSION);

        return Storage::disk('public')->download($filePath, $downloadName);
    }

    /**
     * SHARE galeri (kalau kamu butuh endpoint share).
     */
    public function share(Gallery $gallery, Request $request)
    {
        $shareUrl = route('guest.gallery.show', $gallery->slug ?? $gallery);

        return response()->json([
            'success'  => true,
            'shareUrl' => $shareUrl,
        ]);
    }
}
