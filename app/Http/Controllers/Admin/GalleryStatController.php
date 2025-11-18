<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryStatController extends Controller
{
    public function index()
    {
        // Ambil galeri + stats + jumlah likes (cth kalau masih pakai tabel likes)
        $galleries = Gallery::with('stats')
            ->withCount('likes')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.gallery-stats.index', compact('galleries'));
    }
}
