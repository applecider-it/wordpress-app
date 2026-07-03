<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @fonts

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Header -->
    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-4 flex items-center justify-between">
            
            <!-- Logo / Title -->
            <a href="/">
                <h1 class="text-xl font-bold">
                    {{ config('app.name', 'Laravel') }}
                </h1>
            </a>

            <!-- Navigation -->
            <nav class="flex gap-6">
                <a href="/" class="text-gray-700 hover:text-blue-600">
                    Top
                </a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="mx-auto max-w-7xl p-6">
        @yield('content')
    </main>

</body>
</html>