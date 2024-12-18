<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Listado de Formularios 3CS') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">

                <!-- Formulario de Filtros arriba de la tabla -->
                <form method="GET" action="{{ route('formularios-3cs.index') }}" class="mb-6">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="flex items-center space-x-2">
                            <label for="mes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Selecciona un mes:</label>
                            <select name="mes" id="mes" class="border px-3 py-2 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500 dark:bg-gray-800 dark:text-gray-300">
                                @foreach(range(1, 12) as $mes)
                                    <option value="{{ $mes }}" @if(request('mes') == $mes) selected @endif>
                                        {{ \Carbon\Carbon::createFromFormat('m', $mes)->locale('es')->monthName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center space-x-2">
                            <label for="año" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Selecciona un año:</label>
                            <select name="año" id="año" class="border px-3 py-2 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500 dark:bg-gray-800 dark:text-gray-300">
                                @foreach(range(2020, date('Y')) as $año)
                                    <option value="{{ $año }}" @if(request('año') == $año) selected @endif>
                                        {{ $año }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="ml-4 inline-flex items-center px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-all duration-300 ease-in-out">
                            Filtrar
                        </button>
                    </div>
                </form>

                <!-- Tabla de Formularios -->
                @if ($formularios->count())
                    <table class="min-w-full bg-white dark:bg-gray-800 table-auto">
                        <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Día de la Consulta</th>
                            <th class="px-4 py-2 text-left text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">No. Historia Clínica</th>
                            <th class="px-4 py-2 text-left text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Nombres y Apellidos</th>
                            <th class="px-4 py-2 text-left text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">CUI</th>
                            <th class="px-4 py-2 text-left text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Vacunas</th>
                            <th class="px-4 py-2 text-left text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($formularios as $formulario)
                            <tr class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                                <td class="px-4 py-2 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $formulario->dia_consulta }}</td>
                                <td class="px-4 py-2 text-sm text-gray-600 dark:text-gray-300">{{ $formulario->no_historia_clinica }}</td>
                                <td class="px-4 py-2 text-sm text-gray-600 dark:text-gray-300">{{ $formulario->nombre_paciente }}</td>
                                <td class="px-4 py-2 text-sm text-gray-600 dark:text-gray-300">{{ $formulario->cui }}</td>
                                <td class="px-4 py-2 text-sm text-gray-600 dark:text-gray-300">
                                    @foreach ($formulario->consulta as $consulta)
                                        {{ $consulta->tratamiento_descripcion }} @if (!$loop->last), @endif
                                    @endforeach
                                </td>
                                <td class="px-4 py-2 text-sm font-medium space-x-4 flex justify-start">
                                    <!-- Enlace para editar -->
                                    <a href="{{ route('formularios-3cs.edit', ['formularios_3c' => $formulario->id]) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white font-semibold rounded-lg shadow hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50 transition-all duration-300 ease-in-out">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12l4 4m0 0l4-4m-4 4l4-4m-4 4l-4-4" />
                                        </svg>
                                        Editar
                                    </a>

                                    <!-- Formulario para eliminar -->
                                    <form action="{{ route('formularios-3cs.destroy', ['formularios_3c' => $formulario->id]) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este formulario?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-semibold rounded-lg shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 transition-all duration-300 ease-in-out">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13H5m2 4h10m-3 0H8m8-12h-4l-1-1h-2l-1 1H7V3h10v2z" />
                                            </svg>
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="mt-6 text-gray-700 dark:text-gray-200">No hay formularios aún.</p>
                @endif

                <br>

                <!-- Botón Crear Nuevo Formulario -->
                <div class="flex justify-center mt-6">
                    <a href="{{ route('formularios-3cs.create') }}" class="inline-flex items-center px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-all duration-300 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Crear nuevo formulario
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
