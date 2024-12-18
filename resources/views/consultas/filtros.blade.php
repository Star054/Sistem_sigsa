<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Filtrar/Consultar Información') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Incluyendo tu buscador personalizado -->
                    <x-barra-busqueda />
                </div>
            </div>
        </div>

        <br>

        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form method="GET" action="{{ route('vacunas.resultados') }}" class="space-y-4">
                            <div class="space-y-1">
                                <label for="tipo_formulario" class="block text-md font-medium text-gray-700 dark:text-gray-300">Seleccionar tipo de formulario:</label>
                                <select name="tipo_formulario" id="tipo_formulario" required class="block w-full px-2 py-1 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-gray-700 dark:text-gray-300">
                                    <option value="SIGSA5b" {{ request()->input('tipo_formulario') == 'SIGSA5b' ? 'selected' : '' }}>SIGSA5b</option>
                                    <option value="SIGSA5bA" {{ request()->input('tipo_formulario') == 'SIGSA5bA' ? 'selected' : '' }}>SIGSA5bA</option>
                                    <option value="SIGSA3CS" {{ request()->input('tipo_formulario') == 'SIGSA3CS' ? 'selected' : '' }}>SIGSA3CS</option>
                                </select>
                            </div>

                            <br>

                            <div class="space-y-1">
                                <label for="vacuna" class="block text-md font-medium text-gray-700 dark:text-gray-300">Seleccionar vacuna:</label>
                                <select name="vacuna" id="vacuna" required class="block w-full px-2 py-1 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-gray-700 dark:text-gray-300">
                                    @foreach($vacunas as $vacunaItem)
                                        <option value="{{ $vacunaItem->nombre_vacuna }}" {{ request()->input('vacuna') == $vacunaItem->nombre_vacuna ? 'selected' : '' }}>
                                            {{ $vacunaItem->nombre_vacuna }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <br>

                            <div class="space-y-1">
                                <label for="mes" class="block text-md font-medium text-gray-700 dark:text-gray-300">Seleccionar mes:</label>
                                <input type="month" name="mes" id="mes" value="{{ request()->input('mes') }}" required class="block w-full px-2 py-1 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-gray-700 dark:text-gray-300">
                            </div>

                            <br>
                            <!-- Botón para aplicar los filtros -->
                            <div class="flex justify-end">
                                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 transition">
                                    Filtrar
                                </button>
                            </div>
                        </form>

                        <!-- Mostrar los resultados filtrados solo si se ha realizado la búsqueda -->
                        @if(request()->has('tipo_formulario') || request()->has('vacuna') || request()->has('mes'))
                            @if(isset($pacientes) && count($pacientes) > 0)
                                <div class="mt-6">
                                    <h4 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Resultados:</h4>
                                    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md">
                                        @if(request()->input('tipo_formulario') == 'SIGSA5b')
                                            @foreach($pacientes as $paciente)
                                                <p>Nombre: {{ $paciente->formularioSIGSA5b->nombre_paciente }}</p>
                                                <p>Fecha de Vacunación: {{ $paciente->fecha_vacunacion ?? 'No disponible' }}</p>
                                                <p>Dosis: {{ $paciente->dosis ?? 'No disponible' }}</p>
                                                <p>Vacuna: {{ $paciente->vacuna->nombre_vacuna ?? 'No disponible' }}</p>
                                            @endforeach
                                        @elseif(request()->input('tipo_formulario') == 'SIGSA5bA')
                                            @foreach($pacientes as $paciente)
                                                <p>Nombre: {{ $paciente->nombre_paciente }}</p>
                                                <p>Fecha de Administración: {{ $paciente->fecha_administracion ?? 'No disponible' }}</p>
                                                <p>Dosis: {{ $paciente->dosis ?? 'No disponible' }}</p>
                                                <p>Vacuna: {{ $paciente->vacuna->nombre_vacuna ?? 'No disponible' }}</p>
                                            @endforeach
                                        @elseif(request()->input('tipo_formulario') == 'SIGSA3CS')
                                            @foreach($pacientes as $paciente)
                                                <p>Nombre: {{ $paciente->nombre_paciente }}</p>
                                                <p>Fecha de Consulta: {{ $paciente->dia_consulta ?? 'No disponible' }}</p>
                                                <p>Tratamiento: {{ $paciente->consulta->tratamiento_descripcion ?? 'No disponible' }}</p>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @else
                                <p class="text-gray-500 dark:text-gray-400 mt-4">No se encontraron resultados.</p>
                            @endif
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
