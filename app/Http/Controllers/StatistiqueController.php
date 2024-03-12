<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Event;
use App\Models\Category;
use App\Models\Reservation;

class StatistiqueController extends Controller
{
    public function index()
    {
        // Nombre total d'utilisateurs
        $totalUsers = User::count();

        // Nombre total d'événements
        $totalEvents = Event::count();

        // Nombre total de catégories
        $totalCategories = Category::count();

        // Nombre total de réservations
        $totalReservations = Reservation::count();

        $user = Auth::user();
        $totalReservationsByOrganizer = $user->events()->join('reservations', 'events.id', '=', 'reservations.event_id')->count();

        return view('statistiques.statistiques', compact('totalUsers', 'totalEvents', 'totalCategories', 'totalReservations', 'totalReservationsByOrganizer'));
    
    }
}
