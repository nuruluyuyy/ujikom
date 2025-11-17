<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Agenda;
use Illuminate\Http\Request;

class GuestNewsController extends Controller
{
    public function index()
    {
        // Update agenda statuses
        Agenda::all()->each->updateStatus();
        
        // Get published news
        $news = News::published()->take(6)->get();
        
        // Get upcoming and ongoing agendas
        $upcomingAgendas = Agenda::upcoming()->take(5)->get();
        $ongoingAgendas = Agenda::ongoing()->get();
        
        return view('guest.news', compact('news', 'upcomingAgendas', 'ongoingAgendas'));
    }

    public function show($slug)
    {
        $newsItem = News::where('slug', $slug)->where('status', 'published')->firstOrFail();
        $latestNews = News::published()->where('id', '!=', $newsItem->id)->take(3)->get();
        
        return view('guest.news-detail', compact('newsItem', 'latestNews'));
    }
}
