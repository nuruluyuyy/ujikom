<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Category;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Get all galleries with categories
     */
    public function index()
    {
        $galleries = Gallery::with('category')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Galleries retrieved successfully',
            'data' => $galleries
        ]);
    }

    /**
     * Get galleries by category
     */
    public function byCategory($categoryId)
    {
        $galleries = Gallery::with('category')
            ->where('category_id', $categoryId)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Galleries retrieved successfully',
            'data' => $galleries
        ]);
    }

    /**
     * Get single gallery detail
     */
    public function show($id)
    {
        $gallery = Gallery::with(['category', 'likes', 'comments' => function($query) {
            $query->where('is_approved', true);
        }])->find($id);

        if (!$gallery) {
            return response()->json([
                'success' => false,
                'message' => 'Gallery not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Gallery retrieved successfully',
            'data' => $gallery
        ]);
    }

    /**
     * Get all categories
     */
    public function categories()
    {
        $categories = Category::withCount('galleries')->get();

        return response()->json([
            'success' => true,
            'message' => 'Categories retrieved successfully',
            'data' => $categories
        ]);
    }
}
