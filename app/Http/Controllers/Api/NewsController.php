<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Agenda;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Get all published news
     */
    public function index()
    {
        $news = News::published()->get();

        return response()->json([
            'success' => true,
            'message' => 'News retrieved successfully',
            'data' => $news
        ]);
    }

    /**
     * Get single news detail
     */
    public function show($slug)
    {
        $news = News::where('slug', $slug)
            ->where('status', 'published')
            ->first();

        if (!$news) {
            return response()->json([
                'success' => false,
                'message' => 'News not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'News retrieved successfully',
            'data' => $news
        ]);
    }

    /**
     * Get news by category
     */
    public function byCategory($category)
    {
        $news = News::published()
            ->where('category', $category)
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'News retrieved successfully',
            'data' => $news
        ]);
    }

    /**
     * Get all agendas
     */
    public function agendas()
    {
        // Update statuses
        Agenda::all()->each->updateStatus();

        $upcoming = Agenda::upcoming()->get();
        $ongoing = Agenda::ongoing()->get();

        return response()->json([
            'success' => true,
            'message' => 'Agendas retrieved successfully',
            'data' => [
                'upcoming' => $upcoming,
                'ongoing' => $ongoing
            ]
        ]);
    }
}
