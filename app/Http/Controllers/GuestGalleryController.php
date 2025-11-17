<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gallery;

class GuestGalleryController extends Controller
{
    public function index()
    {
        // Ambil semua kategori + relasi galeri
        $categories = Category::with('galleries')->get();

        // Ambil semua galeri terbaru + relasi kategori dan likes
        $galleries = Gallery::with(['category', 'likes'])->latest()->get();

        // Hitung likes untuk setiap gallery
        $galleries->each(function($gallery) {
            $gallery->likes_count = $gallery->likes->count();
        });

        // Jika tidak ada galleries, set empty collection
        if ($galleries->isEmpty()) {
            $galleries = collect([]);
        }

        // Get user IP for checking likes
        $userIp = request()->ip();

        // Kirim ke view
        return view('guest.gallery', compact('categories', 'galleries', 'userIp'));
    }

    public function show(Gallery $gallery)
    {
        $gallery->load(['category', 'likes']);
        $gallery->likes_count = $gallery->likes->count();
        $userIp = request()->ip();
        $gallery->is_liked = $gallery->isLikedBy($userIp);
        
        $relatedGalleries = Gallery::where('category_id', $gallery->category_id)
            ->where('id', '!=', $gallery->id)
            ->with('category')
            ->latest()
            ->take(4)
            ->get();
        
        return view('guest.gallery-detail', compact('gallery', 'relatedGalleries', 'userIp'));
    }
}
