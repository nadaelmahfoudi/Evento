<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <!-- Main content -->

    <div class="flex justify-center">
        <div class="w-full p-6 flex ">
            @include('layouts.sidebar')
            <section class="container  mx-auto">
                <h2 class="text-lg font-medium text-gray-800 dark:text-white mb-4">Events</h2>
                    
                @if ($message = Session::get('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ $message }}</span>
                    </div>
                @endif
                @if ($message = Session::get('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">{{ $message }}</span>
                    </div>
                @endif

                
                <a class="btn btn-info bg-green-400 py-2 px-4 rounded" href="{{ route('events.create') }}">Create a new Event</a>

                <div class="flex flex-col mt-6">
                    <div class="  overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                            <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
    <thead class="bg-gray-50 dark:bg-gray-800">
        <tr>
            <!-- <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">No</th> -->
            <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">Titre</th>
            <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">Description</th>
            <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">Date</th>
            <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">Lieu</th>
            <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">Image</th>
            <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">Methode de validation</th>
            <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">Nom de Category</th>
            <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">Capacity</th>
            <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">Actions</th>
            @if (Auth::user()->HasRole('organizer'))
            <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">Réservations</th>
            @endif
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700">
        @foreach ($events as $event)
        <tr>
            <!-- <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">{{ $loop->iteration }}</td> -->
            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">{{ $event->titre }}</td>
            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">{{ Str::limit($event->description, 5) }}</td>
            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">{{ $event->date }}</td>
            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">{{ Str::limit($event->lieu, 3) }}</td>
            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                @if ($event->image)
                <img src="{{ asset('storage/' . $event->image) }}" alt="Event Image">
                @else
                <p>No image available</p>
                @endif
            </td>
            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">{{ $event->validation }}</td>
            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                @if ($event->category)
                {{ $event->category->name }}
                @else
                <span class="text-red-500">No category associated</span>
                @endif
            </td>
            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">{{ $event->capacity }}</td>
            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
            
                <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="flex">
                    <a class="btn btn-info mr-2 bg-orange-400 py-2 px-4 rounded" href="{{ route('events.show', $event->id) }}">Show</a>
                @if (Auth::user()->HasRole('organizer'))
                    <a class="btn btn-primary mr-2 bg-blue-700 py-2 px-4 rounded" href="{{ route('events.edit', $event->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger bg-red-700 py-2 px-4 rounded">Delete</button>
                </form>
            </td>
            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                @if ($event->reservations->isEmpty())
                    <p>Aucune réservation en attente pour cet événement.</p>
                @else
                    @foreach ($event->reservations as $reservation)
                        <div class="reservation">
                            <p>{{ $reservation->user->name }} a réservé pour l'événement "{{ $reservation->event->titre }}"</p>
                            <a href="{{ route('reservations.updateStatus', ['reservation' => $reservation->id, 'status' => 'acceptée']) }}" class="btn btn-info mr-2 bg-green-400 py-2 px-2  rounded">Accepter</a>
                            <a href="{{ route('reservations.updateStatus', ['reservation' => $reservation->id, 'status' => 'rejetée']) }}" class="btn btn-info mr-2 bg-red-400 py-2 px-2 rounded">Rejeter</a>
                        </div>
                    @endforeach
                @endif
            </td>
            @endif
            @if (Auth::user()->HasRole('admin'))
            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                @if (!$event->accepted)
                    <a href="{{ route('events.accept', $event->id) }}" class="btn btn-success bg-green-600 py-2 px-4 rounded">Accept</a>
                @endif
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>


                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
