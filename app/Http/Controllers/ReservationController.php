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
    
            $reservation = new Reservation();
            $reservation->user_id = $user->id;
            $reservation->event_id = $eventId;

            if ($event->validation === 'automatique') {
                $reservation->status = 'acceptée';
            } else {
                $reservation->status = 'en_attente';
            }
    
            $reservation->save();
            $event->decrement('capacity');
    
            return redirect()->back()->with('success', 'Votre réservation a été effectuée avec succès !');
        } else {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour réserver cet événement.');
        }
    }

    public function updateStatus(Request $request, $reservationId) {
        
        $reservation = Reservation::findOrFail($reservationId);
    
        if ($reservation->event->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Vous n\'avez pas les autorisations nécessaires pour effectuer cette action.');
        }
    
        $request->validate([
            'status' => 'required|in:acceptée,rejetée',
        ]);
    
        $reservation->status = $request->input('status');
        $reservation->save();
    
        return redirect()->back()->with('success', 'Le statut de la réservation a été mis à jour avec succès.');
    }
    
    
    
}
