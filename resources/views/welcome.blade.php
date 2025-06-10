<x-layouts.guest>
    <!-- Welcome Content -->
    <div class="min-h-screen flex flex-col justify-center items-center px-6 pt-8 text-center">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md max-w-lg">

            <!-- Logo/Imagen principal -->
            <div class="flex justify-center mb-6">
                <img src="{{ asset('images/dentassist-logo.png') }}" alt="DentAssist Logo" class="h-32 w-auto object-contain">
                <!-- Imagen de respaldo si la principal no se carga -->
                <noscript>
                    <img src="/images/dentassist-logo.png" alt="DentAssist Logo" class="h-32 w-auto">
                </noscript>
            </div>

            <h2 class="text-4xl font-bold text-gray-800 dark:text-white mb-8">¡Bienvenido a DentAssist!</h2>
            <p class="text-xl text-gray-700 dark:text-gray-300">
                Tu solución integral para la gestión de citas.
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
</x-layouts.guest>
