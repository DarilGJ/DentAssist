<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DentAssist</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Dark mode script -->
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>
<body class="antialiased font-sans h-full bg-gray-100 dark:bg-gray-900">
<!-- Header -->
<header class="bg-blue-600 dark:bg-blue-800 shadow-md">
    <div class="container mx-auto px-6 py-4">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-white">DentAssist</h1>

            <!-- Dark Mode Toggle -->
            <button id="theme-toggle" class="text-white hover:text-gray-200 focus:outline-none">
                <!-- Sun icon for dark mode -->
                <svg id="sun-icon" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <!-- Moon icon for light mode -->
                <svg id="moon-icon" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
            </button>
        </div>
    </div>
</header>

<!-- Welcome Content -->
<div class="min-h-screen flex flex-col justify-center items-center px-6 pt-8 text-center">
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md max-w-lg">
        <h2 class="text-4xl font-bold text-gray-800 dark:text-white mb-8">¡Bienvenido a DentAssist!</h2>
        <p class="text-xl text-gray-700 dark:text-gray-300">
            Tu solución integral para la gestión de clínicas dentales.
        </p>
        <p class="text-gray-600 dark:text-gray-400 mt-6">
            Estamos aquí para hacer que la administración de tu clínica dental sea más sencilla y eficiente.
        </p>

        @if (Route::has('login'))
            <div class="mt-8">
                @auth
                    <a href="{{ url('/dashboard') }}" class="bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 text-white font-bold py-2 px-6 rounded-lg transition duration-300">App</a>
                    @if(auth()->user()->role == \App\Enums\RoleEnum::admin
                            || auth()->user()->role == \App\Enums\RoleEnum::clinic)
                        <a href="{{ url('/clinic') }}" class="bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 text-white font-bold py-2 px-6 rounded-lg transition duration-300">Clinic</a>
                    @endif

                    @if(auth()->user()->role == \App\Enums\RoleEnum::admin)
                        <a href="{{ url('/admin') }}" class="bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 text-white font-bold py-2 px-6 rounded-lg transition duration-300">Admin</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 text-white font-bold py-2 px-6 rounded-lg transition duration-300">Iniciar Sesión</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-white hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 text-blue-600 dark:text-white border border-blue-600 dark:border-gray-600 font-bold py-2 px-6 rounded-lg ml-4 transition duration-300">Registrarse</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</div>

<!-- Footer -->
<footer class="bg-white dark:bg-gray-800 py-4 shadow-md">
    <div class="container mx-auto">
        <p class="text-center text-gray-500 dark:text-gray-400">
            &copy; {{ date('Y') }} DentAssist. Todos los derechos reservados.
        </p>
    </div>
</footer>

<!-- Dark Mode Toggle Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const themeToggle = document.getElementById('theme-toggle');
        const sunIcon = document.getElementById('sun-icon');
        const moonIcon = document.getElementById('moon-icon');

        // Set initial icon state
        if (document.documentElement.classList.contains('dark')) {
            sunIcon.classList.remove('hidden');
            moonIcon.classList.add('hidden');
        } else {
            sunIcon.classList.add('hidden');
            moonIcon.classList.remove('hidden');
        }

        themeToggle.addEventListener('click', function() {
            // Toggle theme
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
                sunIcon.classList.add('hidden');
                moonIcon.classList.remove('hidden');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
                sunIcon.classList.remove('hidden');
                moonIcon.classList.add('hidden');
            }
        });
    });
</script>
</body>
</html>
