<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class GuestAgendaController extends Controller
{
    public function index()
    {
        // Update all agenda statuses
        Agenda::all()->each->updateStatus();
        
        $upcomingAgendas = Agenda::upcoming()->get();
        $ongoingAgendas = Agenda::ongoing()->get();
        
        return view('guest.agenda', compact('upcomingAgendas', 'ongoingAgendas'));
    }
}
