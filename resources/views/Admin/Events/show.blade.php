<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
    <title>Show details Event</title>
</head>

<body class="bg-gray-100">

    <h1 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white text-center">YouTalent</h1>
    <div class="container mx-auto mt-5 p-4 bg-white rounded-lg shadow-lg">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <div>
                <hr class="mb-4">

                <div class="mb-4">
                    <strong class="block text-gray-600">Title:</strong>
                    <p class="text-lg font-bold">{{ $event->titre }}<p>
                </div>

                <div class="mb-4">
                    <strong class="block text-gray-600">Description:</strong>
                    <p>{{ $event->description }}</p>
                </div>

                <div class="mb-4">
                    <strong class="block text-gray-600">Date:</strong>
                    <p>{{ $event->date }}</p>
                </div>

                <div class="mb-4">
                    <strong class="block text-gray-600">lieu:</strong>
                    <p>{{ $event->lieu }}</p>
                </div>

                <div class="mb-4">
                    <strong class="block text-gray-600">Nom de la categorie:</strong>
                    <p>{{ $event->category->name }}</p>
                </div>

                <div class="mb-4">
                    <strong class="block text-gray-600">Capacity:</strong>
                    <p>{{ $event->capacity }}</p>
                </div>
            </div>

        </div>
    </div>

</body>

</html>
