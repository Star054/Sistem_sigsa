@props(['vacunas'])

<div class="container mx-auto px-4 py-6">
    <!-- Motivo de consulta y tratamiento -->
    <div class="overflow-x-auto">
        <!-- Tratamiento y medicación formulada -->
        <table class="table-auto w-full border-collapse mb-6 border border-black dark:border-white">
            <thead>
            <tr>
                <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">Descripción (Vacuna)</th>
                <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">Presentación</th>
                <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">Cantidad Recetada</th>
                <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">Lugar</th>
                <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">Número</th>
                <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">Nombres y apellidos del acompañante</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <!-- Descripción (Vacuna) -->
                <td class="border border-black dark:border-white p-0">
                    <select name="tratamiento_descripcion" class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                        <option value="">Sin seleccionar</option> <!-- Opción vacía -->
                        @foreach($vacunas as $vacuna)
                            <option value="{{ $vacuna->nombre_vacuna }}">{{ $vacuna->nombre_vacuna }}</option>
                        @endforeach
                    </select>
                </td>

                <!-- Presentación -->
                <td class="border border-black dark:border-white p-0">
                    <input type="number" name="tratamiento_presentacion" step="0.001"
                           class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                           placeholder="Presentación (0.005, 1, etc.)">
                </td>

                <!-- Cantidad Recetada -->
                <td class="border border-black dark:border-white p-0">
                    <input type="number" name="cantidad_recetada" step="1"
                           class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                           placeholder="Cantidad (solo enteros)">
                </td>

                <!-- Lugar -->
                <td class="border border-black dark:border-white p-0">
                    <select name="notificacion_lugar"
                            class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                        <option value="">Sin seleccionar</option> <!-- Opción vacía -->
                        <option value="0">No aplica</option>
                        <option value="1">Ministerio Público</option>
                        <option value="2">Procuraduría General de la Nación</option>
                        <option value="3">Policía Nacional Civil</option>
                    </select>
                </td>

                <!-- Número -->
                <td class="border border-black dark:border-white p-0">
                    <input type="text" name="notificacion_numero"
                           class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                           placeholder="Número">
                </td>

                <!-- Nombres y apellidos del acompañante -->
                <td class="border border-black dark:border-white p-0">
                    <input type="text" name="nombre_acompanante"
                           class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                           placeholder="Nombres y apellidos">
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
