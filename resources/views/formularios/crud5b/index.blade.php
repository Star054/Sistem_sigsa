<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Lista de Formularios FOR-SIGSA-5b') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Formulario para seleccionar mes y año -->
                <form method="GET" action="{{ route('for-sigsa-5b.index') }}" class="mb-6">
                    <div class="flex items-center justify-between space-x-4">
                        <div class="flex space-x-4">
                            <!-- Selector de Mes -->
                            <div>
                                <label for="mes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Selecciona un mes:</label>
                                <select name="mes" id="mes" class="border px-3 py-2 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500 dark:bg-gray-800 dark:text-gray-300">
                                    @foreach(range(1, 12) as $mes)
                                        <option value="{{ $mes }}" @if(request('mes') == $mes) selected @endif>
                                            {{ \Carbon\Carbon::createFromFormat('m', $mes)->locale('es')->monthName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Selector de Año -->
                            <div>
                                <label for="año" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Selecciona un año:</label>
                                <select name="año" id="año" class="border px-3 py-2 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500 dark:bg-gray-800 dark:text-gray-300">
                                    @foreach(range(2020, date('Y')) as $año)
                                        <option value="{{ $año }}" @if(request('año') == $año) selected @endif>
                                            {{ $año }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Botón Filtrar -->
                        <button type="submit" class="ml-4 inline-flex items-center px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-all duration-300 ease-in-out">
                            Filtrar
                        </button>
                    </div>
                </form>


                <!-- Contenedor responsive para la tabla -->
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white dark:bg-gray-800 table-auto">
                        <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Nombre</th>
                            <th class="px-4 py-2 text-left text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">CUI</th>
                            <th class="px-4 py-2 text-left text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Sexo</th>
                            <th class="px-4 py-2 text-left text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Vacuna</th>
                            <th class="px-4 py-2 text-left text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($formulariosFiltrados->isEmpty())
                            <tr>
                                <td colspan="5" class="px-4 py-2 text-center text-sm text-gray-600 dark:text-gray-300">No se encontraron formularios para esta fecha.</td>
                            </tr>
                        @else
                            @foreach ($formulariosFiltrados as $formulario)
                                <tr class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                                    <td class="px-4 py-2 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $formulario->nombre_paciente }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-600 dark:text-gray-300">{{ $formulario->cui }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-600 dark:text-gray-300">{{ $formulario->sexo }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-600 dark:text-gray-300">{{ $formulario->vacuna }}</td>
                                    <td class="px-4 py-2 text-sm font-medium space-x-2">
                                        <a href="{{ route('for-sigsa-5b.show', $formulario->id) }}" class="text-blue-500 hover:text-blue-400 dark:text-blue-400 dark:hover:text-blue-300">Ver</a>
                                        <a href="{{ route('for-sigsa-5b.edit', $formulario->id) }}" class="text-yellow-500 hover:text-yellow-400 dark:text-yellow-400 dark:hover:text-yellow-300">Editar</a>
                                        <form action="{{ route('for-sigsa-5b.destroy', $formulario->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este formulario?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-400 dark:text-red-400 dark:hover:text-red-300">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <br>

            <!-- Botones CRUD para la navegación -->
            <div class="bg-gray-50 dark:bg-gray-900 p-6 shadow-lg rounded-lg border border-gray-200 dark:border-gray-700 transition-all duration-300 ease-in-out hover:shadow-xl">
                <div class="container mx-auto px-3 py-5 space-y-5">
                    <div class="flex justify-center space-x-5 mt-5">
                        <!-- Botón Crear Nuevo Formulario -->
                        <a href="{{ route('for-sigsa-5b.create') }}" class="inline-flex items-center px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-all duration-300 ease-in-out">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Nuevo Registro
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
