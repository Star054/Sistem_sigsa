<x-app-layout>
    <div class="container mx-auto px-4 py-6 space-y-8">

        <!-- Iniciar el formulario -->
        <form action="{{ route('formularios-3cs.store') }}" method="POST">
            @csrf  <!-- Token de seguridad de Laravel -->

            <!-- Inputs ocultos para el tipo de formulario -->
            <input type="hidden" name="codigo_formulario" value="FOR-SIGSA-3CS">

            <!-- Encabezado dinámico usando slot para el título y select -->
            <div class="bg-white dark:bg-gray-800 p-6 shadow-lg rounded-lg border border-gray-200 dark:border-gray-700 transition-all duration-300 ease-in-out hover:shadow-xl">
                <x-formulario-slot
                    :mostrarMes="true"
                    codigo="FOR-SIGSA-3CS"
                    version="3.0"
                    vigencia="Noviembre del 2017">
                    REGISTRO DIARIO DE CONSULTA EN CENTRO DE SALUD
                </x-formulario-slot>
            </div>

            <!-- Mensajes de validación -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">¡Oops!</strong>
                    <span class="block sm:inline">Hay algunos problemas con tus datos:</span>
                    <ul class="mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Mensaje de éxito -->
            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">¡Éxito!</strong>
                    <span class="block sm:inline">{{ session('status') }}</span>
                </div>
            @endif

            <br>
            <!-- Componente de datos paciente -->
            <div class="bg-white dark:bg-gray-800 p-6 shadow-lg rounded-lg border border-gray-200 dark:border-gray-700 transition-all duration-300 ease-in-out hover:shadow-xl">
                <x-datosPaciente5b :mostrarNoOrden="false" :mostrarHistoriaClinica="true" :mostrar-dia-consulta="true" :mostrar-discapacidad="true" />
            </div>

            <br>

            <!-- Componente de residencia -->
            <div class="bg-white dark:bg-gray-800 p-6 shadow-lg rounded-lg border border-gray-200 dark:border-gray-700 transition-all duration-300 ease-in-out hover:shadow-xl">
                <x-residencia :mostrarEmbarazada="false" />
            </div>

            <br>

            <div>
                <div class="bg-white dark:bg-gray-800 p-6 shadow-lg rounded-lg border border-gray-200 dark:border-gray-700 transition-all duration-300 ease-in-out hover:shadow-xl">
                    <x-registroConsulta />
                </div>

                <br>

                <div>
                    <div class="bg-white dark:bg-gray-800 p-6 shadow-lg rounded-lg border border-gray-200 dark:border-gray-700 transition-all duration-300 ease-in-out hover:shadow-xl">
                        <x-ComponenteDiagnosticoTratamiento :vacunas="$vacunas" />
                    </div>

                    <br>

                    <!-- Botón de guardar y notificación -->
                    <div class="flex items-center gap-4 mt-6">
                        <x-primary-button type="submit" class="bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-opacity-50 text-white font-semibold rounded-lg py-2 px-4 transition-all duration-300 ease-in-out">
                            {{ __('Guardar') }}
                        </x-primary-button>
                    </div>
                </div>
            </div>
        </form> <!-- Fin del formulario -->

        <!-- Botones CRUD para la navegación -->
        <div class="bg-white dark:bg-gray-800 p-6 shadow-lg rounded-lg border border-gray-200 dark:border-gray-700 transition-all duration-300 ease-in-out hover:shadow-xl">
            <div class="container mx-auto px-3 py-5 space-y-5">
                <div class="flex justify-center space-x-5 mt-5">
                    <!-- Botón Listar Formularios -->
                    <a href="{{ route('formularios-3cs.index') }}" class="inline-flex items-center px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-all duration-300 ease-in-out">
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
