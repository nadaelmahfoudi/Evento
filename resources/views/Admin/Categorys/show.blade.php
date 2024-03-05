<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
    <title>Show details Category</title>
</head>

<body class="bg-gray-100">

    <h1 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white text-center">Eventooooo</h1>
    <div class="container mx-auto mt-5 p-4 bg-white rounded-lg shadow-lg">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <div>
                <hr class="mb-4">

                <div class="mb-4">
                    <strong class="block text-gray-600">Name:</strong>
                    <p class="text-lg font-bold">{{ $category->name }}</p>
                </div>


            </div>

        </div>
    </div>

</body>

</html>
