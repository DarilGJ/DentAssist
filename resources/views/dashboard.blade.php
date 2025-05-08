<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">

        <a href="{{ route('expedientes.create') }}"
   class="group relative rounded-2xl bg-gradient-to-br from-blue-500 to-purple-500 text-white shadow-md p-6 transition duration-300 ease-in-out hover:scale-105 hover:shadow-lg">

    <!-- Decoración de fondo opcional -->
    <div class="absolute inset-0 opacity-10 pointer-events-none bg-gradient-to-br from-white via-white/20 to-transparent"></div>

    <!-- Encabezado -->
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold">➕ Registrar Expediente</h2>
        <span class="text-3xl">🩺</span>
    </div>

    <!-- Descripción mejorada -->
    <p class="text-base leading-relaxed text-white">
        Inicia el registro de un nuevo expediente clínico para tus pacientes de forma rápida y estructurada.
    </p>

    <!-- CTA al pie -->
    <div class="absolute bottom-4 right-4 flex items-center gap-1 text-sm text-white/80 group-hover:text-white transition">
        <span>Ir</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:translate-x-1 transition-transform" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 5l7 7-7 7" />
        </svg>
    </div>
</a>


            <!-- Espacios reservados -->
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>

        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
    </div>
</x-layouts.app>
