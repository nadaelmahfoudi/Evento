@extends('layouts.default')
@section('content')
<div class="container">
    <h1>Tickets</h1>

    <h2>Réservations de {{ Auth::user()->name }}</h2>

    @if ($reservations->isEmpty())
        <p>Pas de réservation effectuée.</p>
    @else
    
    @foreach ($reservations as $reservation)
        <a href="#" class="relative block overflow-hidden rounded-lg border border-gray-100 p-4 sm:p-6 lg:p-8">
            <span class="absolute inset-x-0 bottom-0 h-2 bg-gradient-to-r from-green-300 via-blue-500 to-purple-600"></span>

            <div class="sm:flex sm:justify-between sm:gap-4">
                <div>
                    <h3 class="text-lg font-bold text-gray-900 sm:text-xl">{{ $reservation->event->titre }}</h3>
                    <p class="mt-1 text-xs font-medium text-gray-600">By {{ $reservation->event->user->name }}</p>
                </div>

                <div class="hidden sm:block sm:shrink-0">
                    <img src="{{ asset('storage/' . $reservation->event->image )}}" alt="" class="size-16 rounded-lg object-cover shadow-sm" />
                </div>
            </div>

            <div class="mt-4">
                <p class="text-pretty text-sm text-gray-500">{{ $reservation->event->description }}</p>
            </div>

            <dl class="mt-6 flex gap-4 sm:gap-6">
                <div class="flex flex-col-reverse">
                    <dt class="text-sm font-medium text-gray-600">Published</dt>
                    <dd class="text-xs text-gray-500">{{ $reservation->event->created_at->format('d/m/Y') }}</dd>
                </div>

                <div class="flex flex-col-reverse">
                    <dt class="text-sm font-medium text-gray-600">Event time</dt>
                    <dd class="text-xs text-gray-500">{{ $reservation->event->date }} minutes</dd>
                </div>
            </dl>

            @if ($reservation->status === 'en_attente')
                <div class="mt-4 text-red-500">La réservation de {{ $reservation->event->titre }} est en attente de réponse.</div>
            @elseif ($reservation->status === 'acceptée')
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Télécharger
            </button>

            @endif

        </a>
    @endforeach
    @endif
</div>
@endsection
