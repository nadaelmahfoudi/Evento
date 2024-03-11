@extends('layouts.default')
@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-center">Tickets</h1>

    <h2 class="text-center">Réservations de {{ Auth::user()->name }}</h2>

    @if ($reservations->isEmpty())
        <p class="text-center">Pas de réservation effectuée.</p>
    @else
    
    @foreach ($reservations as $reservation)
        <div class="relative block overflow-hidden rounded-lg border border-gray-100 p-4 sm:p-6 lg:p-8 mb-4 mx-auto" style="position: relative;">
            <div class="bg-cover bg-center w-full h-full absolute top-0 left-0" style="background-image: url('{{ asset('storage/' . $reservation->event->image )}}'); filter: blur(5px);"></div>
            <div class="relative z-10">

                <div class="sm:flex sm:justify-between sm:gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-white sm:text-xl">{{ $reservation->event->titre }}</h3>
                        <p class="mt-1 text-xs font-medium text-gray-200">By {{ $reservation->event->user->name }}</p>
                    </div>
                </div>

                <div class="mt-4">
                    <p class="text-pretty text-sm text-gray-100">{{ $reservation->event->description }}</p>
                </div>

                <dl class="mt-6 flex gap-4 sm:gap-6">
                    <div class="flex flex-col-reverse">
                        <dt class="text-sm font-medium text-gray-200">Published</dt>
                        <dd class="text-xs text-gray-100">{{ $reservation->event->created_at->format('d/m/Y') }}</dd>
                    </div>

                    <div class="flex flex-col-reverse">
                        <dt class="text-sm font-medium text-gray-200">Event time</dt>
                        <dd class="text-xs text-gray-100">{{ $reservation->event->date }} minutes</dd>
                    </div>
                </dl>

                @if ($reservation->status === 'en_attente')
                    <div class="mt-4 text-red-500">La réservation de {{ $reservation->event->titre }} est en attente de réponse.</div>
                @elseif ($reservation->status === 'acceptée')
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Télécharger
                    </button>
                @endif

            </div>
        </div>
    @endforeach
    @endif
</div>
@endsection
