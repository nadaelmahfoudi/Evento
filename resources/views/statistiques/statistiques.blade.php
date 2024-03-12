@extends('layouts.default')

@section('content')
    <div class="container">
    @if (Auth::user()->HasRole('admin'))
        <h1 class="text-3xl font-bold mb-4">Statistiques</h1>

        <div class="bg-gray-200 p-4 rounded-lg mb-4">
            <h2 class="text-xl font-semibold mb-2">Nombre total d'utilisateurs :</h2>
            <p class="text-lg">{{ $totalUsers }}</p>
        </div>

        <div class="bg-gray-200 p-4 rounded-lg mb-4">
            <h2 class="text-xl font-semibold mb-2">Nombre total d'événements :</h2>
            <p class="text-lg">{{ $totalEvents }}</p>
        </div>

        <div class="bg-gray-200 p-4 rounded-lg mb-4">
            <h2 class="text-xl font-semibold mb-2">Nombre total de catégories :</h2>
            <p class="text-lg">{{ $totalCategories }}</p>
        </div>

        <div class="bg-gray-200 p-4 rounded-lg mb-4">
            <h2 class="text-xl font-semibold mb-2">Nombre total de réservations :</h2>
            <p class="text-lg">{{ $totalReservations }}</p>
        </div>
        @endif
        @if (Auth::user()->HasRole('organizer'))
        <div class="bg-gray-200 p-4 rounded-lg mb-4">
            <h2 class="text-xl font-semibold mb-2">Nombre total de réservations pour les événements de l'organisateur :</h2>
            <p class="text-lg">{{ $totalReservationsByOrganizer }}</p>
        </div>
        @endif
    </div>
@endsection
