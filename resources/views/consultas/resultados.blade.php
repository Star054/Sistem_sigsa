<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Resultados de Pacientes Vacunados - 5b') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Título -->
                    <h4 class="text-lg font-semibold mb-4">Resultados:</h4>

                    <!-- Contenedor de la tabla -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto border-collapse border border-gray-300 dark:border-gray-600">
                            <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-left text-sm uppercase font-semibold">
                                <th class="py-3 px-4 border">Área de Salud</th>
                                <th class="py-3 px-4 border">Distrito de Salud</th>
                                <th class="py-3 px-4 border">Municipio</th>
                                <th class="py-3 px-4 border">Servicio de Salud</th>
                                <th class="py-3 px-4 border">Responsable Información</th>
                                <th class="py-3 px-4 border">Cargo Responsable</th>
                                <th class="py-3 px-2 border">Año</th>
                                <th class="py-3 px-2 border">No. Orden</th>
                                <th class="py-3 px-6 border">Nombres y Apellidos</th>
                                <th class="py-3 px-4 border">CUI</th>
                                <th class="py-3 px-2 border">Sexo</th>
                                <th class="py-3 px-4 border">Pueblo</th>
                                <th class="py-3 px-4 border">Fecha de Nacimiento</th>
                                <th class="py-3 px-4 border">Comunidad Lingüística</th>
                                <th class="py-3 px-4 border">Orientación Sexual</th>
                                <th class="py-3 px-4 border">Escolaridad</th>
                                <th class="py-3 px-4 border">Profesión u Oficio</th>
                                <th class="py-3 px-4 border">Comunidad Dirección</th>
                                <th class="py-3 px-4 border">Municipio Residencia</th>
                                <th class="py-3 px-2 border">Agrícola Migrante</th>
                                <th class="py-3 px-2 border">Embarazada</th>
                                <th class="py-3 px-4 border">Grupo</th>
                                <th class="py-3 px-4 border">Fecha Vacunación</th>
                                <th class="py-3 px-4 border">Tipo Dosis</th>
                            </tr>
                            </thead>
                            <tbody class="text-gray-700 dark:text-gray-300">
                            @if($pacientes->isNotEmpty())
                                @foreach($pacientes as $paciente)
                                    @foreach($paciente->mujer15a49yOtrosGrupos as $grupo)
                                        @if(
                                            !empty($grupo->fecha_vacunacion) &&
                                            \Carbon\Carbon::parse($grupo->fecha_vacunacion)->month == \Carbon\Carbon::parse(request('mes'))->month &&
                                            \Carbon\Carbon::parse($grupo->fecha_vacunacion)->year == \Carbon\Carbon::parse(request('mes'))->year
                                        )
                                            <tr class="border-b dark:border-gray-700">
                                                <td class="py-3 px-4 border border-gray-300 dark:border-gray-600">{{ $paciente->area_salud }}</td>
                                                <td class="py-3 px-4 border border-gray-300 dark:border-gray-600">{{ $paciente->distrito_salud }}</td>
                                                <td class="py-3 px-4 border border-gray-300 dark:border-gray-600">{{ $paciente->municipio }}</td>
                                                <td class="py-3 px-4 border border-gray-300 dark:border-gray-600">{{ $paciente->servicio_salud }}</td>
                                                <td class="py-3 px-4 border border-gray-300 dark:border-gray-600">{{ $paciente->responsable_informacion }}</td>
                                                <td class="py-3 px-4 border border-gray-300 dark:border-gray-600">{{ $paciente->cargo_responsable }}</td>
                                                <td class="py-3 px-2 border border-gray-300 dark:border-gray-600">{{ $paciente->anio }}</td>
                                                <td class="py-3 px-2 border border-gray-300 dark:border-gray-600">{{ $paciente->no_orden }}</td>
                                                <td class="py-3 px-6 border border-gray-300 dark:border-gray-600">{{ $paciente->nombre_paciente }}</td>
                                                <td class="py-3 px-4 border border-gray-300 dark:border-gray-600">{{ $paciente->cui }}</td>
                                                <td class="py-3 px-2 border border-gray-300 dark:border-gray-600">{{ $paciente->sexo }}</td>
                                                <td class="py-3 px-4 border border-gray-300 dark:border-gray-600">{{ $paciente->pueblo }}</td>
                                                <td class="py-3 px-4 border border-gray-300 dark:border-gray-600">{{ $paciente->fecha_nacimiento }}</td>
                                                <td class="py-3 px-4 border border-gray-300 dark:border-gray-600">{{ $paciente->comunidad_linguistica }}</td>
                                                <td class="py-3 px-4 border border-gray-300 dark:border-gray-600">{{ $paciente->orientacion_sexual }}</td>
                                                <td class="py-3 px-4 border border-gray-300 dark:border-gray-600">{{ $paciente->escolaridad }}</td>
                                                <td class="py-3 px-4 border border-gray-300 dark:border-gray-600">{{ $paciente->profesion_oficio }}</td>
                                                <td class="py-3 px-4 border border-gray-300 dark:border-gray-600">{{ $paciente->residencia->comunidad_direccion ?? 'N/A' }}</td>
                                                <td class="py-3 px-4 border border-gray-300 dark:border-gray-600">{{ $paciente->residencia->municipio_residencia ?? 'N/A' }}</td>
                                                <td class="py-3 px-2 border border-gray-300 dark:border-gray-600">{{ $paciente->residencia->agricola_migrante ?? 'N/A' }}</td>
                                                <td class="py-3 px-2 border border-gray-300 dark:border-gray-600">{{ $paciente->residencia->embarazada ?? 'N/A' }}</td>
                                                <td class="py-3 px-4 border border-gray-300 dark:border-gray-600">{{ $grupo->grupo }}</td>
                                                <td class="py-3 px-4 border border-gray-300 dark:border-gray-600">{{ $grupo->fecha_vacunacion }}</td>
                                                <td class="py-3 px-4 border border-gray-300 dark:border-gray-600">{{ $grupo->tipo_dosis }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="24" class="py-4 px-6 text-center text-red-500">No se encontraron resultados.</td>
                                </tr>
                            @endif
                            </tbody>

                        </table>
                    </div>

                    <!-- Botón para generar PDF -->
                    <div class="mt-6">
                        <form action="{{ route('pdf.generar5b') }}" method="POST">
                            @csrf
                            <input type="hidden" name="vacuna" value="{{ request('vacuna') }}">
                            <input type="hidden" name="mes" value="{{ request('mes') }}">
                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-500 focus:outline-none">
                                Generar PDF Formulario 5b
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
