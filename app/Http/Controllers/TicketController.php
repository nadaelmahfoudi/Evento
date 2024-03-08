<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
{
    $user = Auth::user();

    $reservations = Reservation::where('user_id', $user->id)->get();
    return view('tickets.ticket', ['reservations' => $reservations]);
}
}
