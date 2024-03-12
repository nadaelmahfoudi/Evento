@foreach ($events as $event)
        <a href="https://laravel.com/docs" class="block rounded-lg p-4 shadow-sm shadow-indigo-100">
            <img alt="" src="{{ asset('storage/' . $event->image )}}" class="h-56 w-full rounded-md object-cover" />

            <div class="mt-2">
                <h1>{{$event->titre}}</h1>
                <h3>{{$event->lieu}}</h3>
                
            </div>

            <div class="mt-4 flex justify-between">
                <form method="POST" action="{{ route('reservation.reserve', $event->id) }}" enctype="multipart/form-data">
                    @csrf
                    <input type="submit" value="Book Now" class="px-4 py-2 bg-blue rounded-md">
                </form>
                <form method="POST" action="{{ route('events.show', $event->id) }}" enctype="multipart/form-data">
                    @csrf
                    <input type="submit" value="Read More" class="px-4 py-2 bg-blue rounded-md">
                </form>
            </div>
        </a>
        @endforeach