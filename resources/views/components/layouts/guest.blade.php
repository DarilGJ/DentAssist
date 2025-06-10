<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{{ config('app.name') }} | {{ $title ?? '' }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
    <header class="flex items-center justify-between px-6 py-4 bg-white dark:bg-gray-900 shadow-md">
        <h1 class="text-xl font-semibold text-gray-900 dark:text-white">{{ config('app.name') }}</h1>
        <button id="toggleDark" class="text-gray-900 dark:text-white border border-gray-300 dark:border-gray-700 px-3 py-1 rounded hover:bg-gray-100 dark:hover:bg-gray-800 transition">
            🌙 / ☀️
        </button>
    </header>

    {{ $slot }}

    <!-- Footer -->
    <footer class="bg-white dark:bg-gray-800 py-4 shadow-md">
        <div class="container mx-auto">
            <p class="text-center text-gray-500 dark:text-gray-400">
                &copy; {{ date('Y') }} {{config('app.name')}}. Todos los derechos reservados.
            </p>
        </div>
    </footer>
</body>
<script>
    const toggleBtn = document.getElementById('toggleDark');
    toggleBtn.addEventListener('click', () => {
        document.documentElement.classList.toggle('dark');
    });
</script>
</html>
