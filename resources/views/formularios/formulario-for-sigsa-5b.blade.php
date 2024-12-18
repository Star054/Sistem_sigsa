<x-app-layout>
    <div class="container mx-auto px-4 py-6 space-y-8">

        <!-- Iniciar el formulario -->
        <form action="{{ route('for-sigsa-5b.store') }}" method="POST">
            @csrf  <!-- Token de seguridad de Laravel -->

            <!-- Inputs ocultos para el tipo de formulario -->
            <input type="hidden" name="codigo_formulario" value="FOR-SIGSA-5b">

            <!-- Encabezado dinámico -->
            <div class="bg-white dark:bg-gray-800 p-6 shadow-lg rounded-lg border border-gray-200 dark:border-gray-700 transition-all duration-300 ease-in-out hover:shadow-xl">
                <x-formulario-slot
                    codigo="FOR-SIGSA-5b"
                    version="3.0"
                    vigencia="Noviembre 2017">
                    REGISTRO DE VACUNACION PARA LA MUJER DE 15 A 49 AÑOS Y OTROS GRUPOS
                    <br>
                    <div class="flex justify-end items-center mt-2 space-x-2">
                        <label for="vacuna" class="text-sm text-gray-600 dark:text-gray-400">Seleccione la vacuna:</label>
                        <select name="vacuna" id="vacuna" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-1 rounded-md text-sm w-auto">
                            <option value="" disabled selected>Seleccione una vacuna</option>
                            @foreach($vacunas as $vacuna)
                                <option value="{{ $vacuna->nombre_vacuna }}">{{ $vacuna->nombre_vacuna }}</option>
                            @endforeach
                        </select>
                    </div>
                </x-formulario-slot>
            </div>

            <!-- Mensajes de validación -->
            @if ($errors->any())
                <div class="bg-white dark:bg-gray-800 p-6 shadow-lg rounded-lg border border-red-400 dark:border-red-700 transition-all duration-300 ease-in-out hover:shadow-xl">
                    <strong class="text-red-600 dark:text-red-400">¡Oops!</strong>
                    <span class="block text-sm text-gray-600 dark:text-gray-300">Hay algunos problemas con tus datos:</span>
                    <ul class="mt-2 list-disc list-inside text-red-600 dark:text-red-400">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Mensajes de éxito -->
            @if (session('status') === 'form-saved')
                <div class="bg-green-100 dark:bg-green-900 p-6 shadow-lg rounded-lg border border-green-400 dark:border-green-700 transition-all duration-300 ease-in-out hover:shadow-xl">
                    <p class="text-green-700 dark:text-green-300">{{ __('Vacuna guardada exitosamente.') }}</p>
                </div>
            @endif

            <!-- Alerta de notificación -->
            @if (session('alert'))
                <div class="bg-red-100 dark:bg-red-900 p-4 shadow-lg rounded-lg border border-red-400 dark:border-red-700 transition-all duration-300 ease-in-out hover:shadow-xl">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600 dark:text-red-300 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M12 4a9 9 0 100 18 9 9 0 000-18z" />
                        </svg>
                        <p class="text-red-700 dark:text-red-300 font-semibold">
                            Este paciente ya ha recibido esta vacuna.
                            Si deseas agregar una segunda dosis o refuerzo, edita el registro existente.
                        </p>
                    </div>
                </div>
            @endif

            <br>

            <!-- Componente de datos paciente -->
            <div class="bg-white dark:bg-gray-800 p-6 shadow-lg rounded-lg border border-gray-200 dark:border-gray-700 transition-all duration-300 ease-in-out hover:shadow-xl">
                <x-datosPaciente5b />
            </div>

            <br>

            <!-- Componente de residencia -->
            <div class="bg-white dark:bg-gray-800 p-6 shadow-lg rounded-lg border border-gray-200 dark:border-gray-700 transition-all duration-300 ease-in-out hover:shadow-xl">
                <x-residencia />
            </div>

            <br>

            <!-- Componente de mujer 15 a 49 años y otros grupos -->
            <div class="bg-white dark:bg-gray-800 p-6 shadow-lg rounded-lg border border-gray-200 dark:border-gray-700 transition-all duration-300 ease-in-out hover:shadow-xl">
                <x-mujer15a49yOtrosGrupos />
            </div>

            <br>

            <!-- Botón de guardar -->
            <div class="flex items-center gap-4 mt-6">
                <x-primary-button type="submit" class="bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-opacity-50 text-white font-semibold rounded-lg py-2 px-4 transition-all duration-300 ease-in-out">
                    {{ __('Guardar') }}
                </x-primary-button>
            </div>
        </form> <!-- Fin del formulario -->

        <br>

        <!-- Botones CRUD para la navegación -->
        <div class="bg-white dark:bg-gray-800 p-6 shadow-lg rounded-lg border border-gray-200 dark:border-gray-700 transition-all duration-300 ease-in-out hover:shadow-xl">
            <div class="container mx-auto px-3 py-5 space-y-5">
                <div class="flex justify-center space-x-5 mt-5">
                    <!-- Botón Listar Formularios -->
                    <a href="{{ route('for-sigsa-5bA.index') }}" class="inline-flex items-center px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-all duration-300 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        Ver lista de registros
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
