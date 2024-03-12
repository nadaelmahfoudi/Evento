<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
    <title>Edit an Event</title>
</head>

<body class="bg-gray-100">

    <div class="container mx-auto mt-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold">Edit an Event</h2>
            <a class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700" href="{{ route('dashboard') }}">Back</a>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger bg-red-200 text-red-800 p-4 mb-4">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="titre" class="block text-gray-700 text-sm font-bold mb-2">Titre:</label>
                <input type="text" name="titre" id="titre" value="{{ $event->titre }}" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Titre">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">description:</label>
                <input type="text" name="description" id="description" value="{{ $event->description }}" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="description">
            </div>

            <div class="mb-4">
                <label for="date" class="block text-gray-700 text-sm font-bold mb-2">date:</label>
                <input type="text" name="date" id="date" value="{{ $event->date }}" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="date">
            </div>

            <div class="mb-4">
                <label for="lieu" class="block text-gray-700 text-sm font-bold mb-2">lieu:</label>
                <input type="text" name="lieu" id="lieu" value="{{ $event->lieu }}" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="lieu">
            </div>

            <div class="mb-4">
                <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image:</label>
                <input type="file" name="image" id="image" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-3">
                <label for="category_id" class="block text-gray-700 text-sm font-bold mb-2">Category :</label>
                <select name="category_id" class="form-select">
                    <option value=""></option>
                    @foreach($categorys as $categoryOption)
                        <option value="{{ $categoryOption->id }}" {{ $categoryOption->id == $event->category_id ? 'selected' : '' }}>
                            {{ $categoryOption->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="validation" class="block text-gray-700 text-sm font-bold mb-2">Validation:</label>
                <select name="validation" id="validation" class="form-select">
                    <option value="automatique" {{ $event->validation === 'automatique' ? 'selected' : '' }}>Validation automatique</option>
                    <option value="manuelle" {{ $event->validation === 'manuelle' ? 'selected' : '' }}>Validation manuelle</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="capacity" class="block text-gray-700 text-sm font-bold mb-2">capacity:</label>
                <input type="text" name="capacity" id="capacity" value="{{ $event->capacity }}" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="capacity">
            </div>



            <div class="text-center">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">Submit</button>
            </div>
        </form>
    </div>

</body>

</html>
