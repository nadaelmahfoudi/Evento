<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;

class StatistiqueController extends Controller
{
    public function index()
    {
        // Nombre total d'événements par catégorie
        $eventsByCategory = DB::table('events')
            ->join('categorys', 'events.category_id', '=', 'categorys.id')
            ->select('categorys.name as category_name', DB::raw('count(*) as total'))
            ->groupBy('categorys.name')
            ->get();

        // Nombre total de réservations par événement
        $reservationsPerEvent = DB::table('reservations')
        ->join('events', 'reservations.event_id', '=', 'events.id')
        ->select('events.titre', DB::raw('count(*) as total'))
        ->groupBy('events.titre')
        ->get();

        // Nombre total de réservations par statut
        $reservationsByStatus = DB::table('reservations')
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        return view('statistiques.statistiques', compact('eventsByCategory', 'reservationsPerEvent', 'reservationsByStatus'));
    }
}
