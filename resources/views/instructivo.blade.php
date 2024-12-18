<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Grupos Prioritarios para Vacunas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">

                <h2 class="text-lg font-semibold mt-4">Grupos priorizados (para Hepatitis B e Influenza Estacional)</h2>
                <table class="min-w-full mt-6 bg-white dark:bg-gray-800 table-auto">
                    <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Código</th>
                        <th class="px-4 py-2 text-left text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Grupos priorizados</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                        <td class="border border-gray-300 px-4 py-2">a.</td>
                        <td class="border border-gray-300 px-4 py-2">Embarazadas</td>
                    </tr>
                    <tr class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                        <td class="border border-gray-300 px-4 py-2">b.</td>
                        <td class="border border-gray-300 px-4 py-2">Personal de salud con mayor riesgo laboral (servicios públicos)</td>
                    </tr>
                    <tr class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                        <td class="border border-gray-300 px-4 py-2">c.</td>
                        <td class="border border-gray-300 px-4 py-2">Enfermos crónicos mayores de 36 meses de edad</td>
                    </tr>
                    <tr class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                        <td class="border border-gray-300 px-4 py-2">d.</td>
                        <td class="border border-gray-300 px-4 py-2">Adultos mayores de 60 años internados en asilos</td>
                    </tr>
                    <tr class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                        <td class="border border-gray-300 px-4 py-2">e.</td>
                        <td class="border border-gray-300 px-4 py-2">Personal que atiende al adulto mayor en los asilos</td>
                    </tr>
                    <tr class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                        <td class="border border-gray-300 px-4 py-2">f.</td>
                        <td class="border border-gray-300 px-4 py-2">Personal de salud con mayor riesgo laboral (contacto con secreciones corporales)</td>
                    </tr>
                    <tr class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                        <td class="border border-gray-300 px-4 py-2">g.</td>
                        <td class="border border-gray-300 px-4 py-2">Estudiante de Medicina</td>
                    </tr>
                    <tr class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                        <td class="border border-gray-300 px-4 py-2">h.</td>
                        <td class="border border-gray-300 px-4 py-2">Estudiante de Odontología</td>
                    </tr>
                    <tr class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                        <td class="border border-gray-300 px-4 py-2">i.</td>
                        <td class="border border-gray-300 px-4 py-2">Estudiante Químico Biólogo/Laboratorista</td>
                    </tr>
                    <tr class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                        <td class="border border-gray-300 px-4 py-2">j.</td>
                        <td class="border border-gray-300 px-4 py-2">Estudiante de Enfermería (profesional o auxiliar)</td>
                    </tr>
                    <tr class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                        <td class="border border-gray-300 px-4 py-2">k.</td>
                        <td class="border border-gray-300 px-4 py-2">Estudiante Bachillerato en medicina</td>
                    </tr>
                    <tr class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                        <td class="border border-gray-300 px-4 py-2">l.</td>
                        <td class="border border-gray-300 px-4 py-2">Personal que traslada pacientes a hospitales (cuerpos de socorro)</td>
                    </tr>
                    <tr class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                        <td class="border border-gray-300 px-4 py-2">m.</td>
                        <td class="border border-gray-300 px-4 py-2">Personas que han sufrido violencia sexual</td>
                    </tr>
                    </tbody>
                </table>

                <h2 class="text-lg font-semibold mt-8">Grupos priorizados (específico para vacuna indicada)</h2>
                <table class="min-w-full mt-6 bg-white dark:bg-gray-800 table-auto">
                    <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Código</th>
                        <th class="px-4 py-2 text-left text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Grupos priorizados</th>
                        <th class="px-4 py-2 text-left text-sm font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Vacuna</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                        <td class="border border-gray-300 px-4 py-2">n.</td>
                        <td class="border border-gray-300 px-4 py-2">Personas de 7 a 15 años</td>
                        <td class="border border-gray-300 px-4 py-2">Hepatitis B</td>
                    </tr>
                    <tr class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                        <td class="border border-gray-300 px-4 py-2">n.</td>
                        <td class="border border-gray-300 px-4 py-2">Personas de 7 a 15 años</td>
                        <td class="border border-gray-300 px-4 py-2">IPV</td>
                    </tr>
                    <tr class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                        <td class="border border-gray-300 px-4 py-2">n.</td>
                        <td class="border border-gray-300 px-4 py-2">Personas de 7 a 15 años</td>
                        <td class="border border-gray-300 px-4 py-2">OPV</td>
                    </tr>
                    <tr class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                        <td class="border border-gray-300 px-4 py-2">r.</td>
                        <td class="border border-gray-300 px-4 py-2">Personas de 6 meses en adelante</td>
                        <td class="border border-gray-300 px-4 py-2">SPR</td>
                    </tr>
                    <tr class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                        <td class="border border-gray-300 px-4 py-2">o.</td>
                        <td class="border border-gray-300 px-4 py-2">Niños 2 meses a menores de 1 año</td>
                        <td class="border border-gray-300 px-4 py-2">IPV</td>
                    </tr>
                    <tr class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                        <td class="border border-gray-300 px-4 py-2">p.</td>
                        <td class="border border-gray-300 px-4 py-2">Embarazadas</td>
                        <td class="border border-gray-300 px-4 py-2">Toxoide tetánico</td>
                    </tr>
                    </tbody>
                </table>

                <div class="mt-8">
                    <h2 class="text-lg font-semibold">Notas</h2>
                    <ul class="list-disc list-inside">
                        <li>Las dosis deben aplicarse conforme a las recomendaciones de la Secretaría de Salud.</li>
                        <li>Este instructivo puede estar sujeto a cambios según actualizaciones en las políticas de vacunación.</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
