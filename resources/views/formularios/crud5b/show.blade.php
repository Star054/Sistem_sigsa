<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles del Paciente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">

                <!-- Información del Paciente -->
                <h3 class="text-lg font-semibold">Datos del Paciente</h3>
                <table class="min-w-full bg-white dark:bg-gray-800">
                    <tr>
                        <th class="px-6 py-4">Nombre del Paciente</th>
                        <td class="px-6 py-4">{{ $formulario->nombre_paciente }}</td>
                    </tr>
                    <tr>
                        <th class="px-6 py-4">CUI</th>
                        <td class="px-6 py-4">{{ $formulario->cui ?? 'No registrado' }}</td>
                    </tr>
                    <tr>
                        <th class="px-6 py-4">Fecha de Nacimiento</th>
                        <td class="px-6 py-4">{{ $formulario->fecha_nacimiento ?? 'No registrada' }}</td>
                    </tr>
                    <tr>
                        <th class="px-6 py-4">Sexo</th>
                        <td class="px-6 py-4">{{ $formulario->sexo }}</td>
                    </tr>
                    <tr>
                        <th class="px-6 py-4">Escolaridad</th>
                        <td class="px-6 py-4">{{ $formulario->escolaridad ?? 'No registrada' }}</td>
                    </tr>
                </table>

                <br>

                <!-- Información de Residencia -->
                <h3 class="text-lg font-semibold">Datos de Residencia</h3>
                <table class="min-w-full bg-white dark:bg-gray-800">
                    <tr>
                        <th class="px-6 py-4">Dirección de Comunidad</th>
                        <td class="px-6 py-4">
                            {{ optional($formulario->residencia)->comunidad_direccion ?? 'No registrada' }}
                        </td>
                    </tr>
                    <tr>
                        <th class="px-6 py-4">Municipio de Residencia</th>
                        <td class="px-6 py-4">
                            {{ optional($formulario->residencia)->municipio_residencia ?? 'No registrado' }}
                        </td>
                    </tr>
                    <tr>
                        <th class="px-6 py-4">Agrícola Migrante</th>
                        <td class="px-6 py-4">
                            {{ optional($formulario->residencia)->agricola_migrante ? 'Sí' : 'No' }}
                        </td>
                    </tr>
                    <tr>
                        <th class="px-6 py-4">Embarazada</th>
                        <td class="px-6 py-4">
                            {{ optional($formulario->residencia)->embarazada ? 'Sí' : 'No' }}
                        </td>
                    </tr>
                </table>

                <br>

                <!-- Información de Mujer 15 a 49 años y otros grupos -->
                <h3 class="text-lg font-semibold">Vacunación para Mujer 15 a 49 Años y Otros Grupos</h3>
                <table class="min-w-full bg-white dark:bg-gray-800">
                    <tr>
                        <th class="px-6 py-4">1ª Dosis (Mujer 15-49)</th>
                        <td class="px-6 py-4">
                            {{ optional($formulario->mujer15a49yOtrosGrupos->where('grupo', 'mujer_15_49')->where('tipo_dosis', '1a')->first())->fecha_vacunacion ?? 'No registrada' }}
                        </td>
                    </tr>
                    <tr>
                        <th class="px-6 py-4">2ª Dosis (Mujer 15-49)</th>
                        <td class="px-6 py-4">
                            {{ optional($formulario->mujer15a49yOtrosGrupos->where('grupo', 'mujer_15_49')->where('tipo_dosis', '2a')->first())->fecha_vacunacion ?? 'No registrada' }}
                        </td>
                    </tr>
                    <tr>
                        <th class="px-6 py-4">1ª Dosis (Otros Grupos)</th>
                        <td class="px-6 py-4">
                            {{ optional($formulario->mujer15a49yOtrosGrupos->where('grupo', 'otros_grupos')->where('tipo_dosis', '1a')->first())->fecha_vacunacion ?? 'No registrada' }}
                        </td>
                    </tr>
                    <!-- Agrega más filas según los campos que tengas -->
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
