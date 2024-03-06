<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function reserve(Request $request, $eventId) {
        if (Auth::check()) {
            $user = Auth::user();
    
            if ($user->reservations()->where('event_id', $eventId)->exists()) {
                return redirect()->back()->with('error', 'Vous avez déjà réservé cet événement !');
            }
    
            $event = Event::findOrFail($eventId);
            if ($event->capacity <= 0) {
                return redirect()->back()->with('error', 'Désolé, la capacité maximale pour cet événement est déjà atteinte !');
            }
    
            if ($event->validation === 'automatique') {
                $reservation = new Reservation();
                $reservation->user_id = $user->id;
                $reservation->event_id = $eventId;
                $reservation->save();
    
                $event->decrement('capacity');
    
                return redirect()->back()->with('success', 'Votre réservation a été effectuée avec succès !');
            } else {
                return redirect()->back()->with('error', 'La validation de cet événement est en attente. Veuillez attendre ou contacter l\'organisateur pour plus d\'informations.');
            }
        } else {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour réserver cet événement.');
        }
    }
    
}
