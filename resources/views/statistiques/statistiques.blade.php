@extends('layouts.default')

@section('content')
    <div class="container">
        <h1>Statistiques</h1>

        <h2>Nombre total d'événements par catégorie :</h2>
        <ul>
            @foreach ($eventsByCategory as $event)
                <li>{{ $event->category_name }}: {{ $event->total }}</li>
            @endforeach
        </ul>

        <h2>Nombre total de réservations par événement :</h2>
        <ul>
        @foreach ($reservationsPerEvent as $reservation)
            <li>Événement {{ $reservation->titre }}: {{ $reservation->total }}</li>
        @endforeach
        </ul>

        <h2>Nombre total de réservations par statut :</h2>
        <ul>
            @foreach ($reservationsByStatus as $reservation)
                <li>Statut {{ $reservation->status }}: {{ $reservation->total }}</li>
            @endforeach
        </ul>
    </div>
@endsection
