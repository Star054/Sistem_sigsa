@props(['mostrarMes' => false])

<div class="container mx-auto px-4 py-6">
    <!-- Encabezado del Formulario -->
    <div class="overflow-x-auto">
        <table class="table-auto min-w-full border-collapse mb-6 border border-black dark:border-white">
            <tr>
                <!-- Logos -->
                <td class="border-2 border-black dark:border-white p-2">
                    <div class="flex items-center">
                        <img src="{{ asset('logos/logo.jpg') }}" alt="Logo 1" style="width: 64px; height: auto;" class="mr-4">
                        <img src="{{ asset('logos/logo2.jpg') }}" alt="Logo 2" style="width: 64px; height: auto;">
                    </div>
                </td>

                <!-- Título y selección de vacuna -->
                <th class="border border-black dark:border-white p-6 text-2xl text-center w-3/5 text-gray-900 dark:text-gray-100">
                    <strong>{{ $slot }}</strong>
                </th>

                <!-- Información del formulario -->
                <td class="w-1/5 border border-black dark:border-white p-4 text-sm text-gray-600 dark:text-gray-400">
                    <ul class="list-none p-0 m-0">
                        <li><strong>Código:</strong> {{ $codigo }}</li>
                        <li><strong>Versión:</strong> {{ $version }}</li>
                        <li><strong>Vigente a partir de:</strong> {{ $vigencia }}</li>
                    </ul>
                </td>
            </tr>
        </table>
    </div>

    <!-- Área de Salud y detalles con scroll horizontal -->
    <div class="overflow-x-auto">
        <table class="table-auto min-w-full border-collapse mb-6 border border-black dark:border-white">
            <tr>
                <td class="w-1/4 p-2">
                    <label class="text-gray-700 dark:text-gray-300">Área de Salud:</label>
                    <input type="text" name="area_salud" value="{{ old('area_salud', $formulario->area_salud ?? '') }}" class="w-full border-none border-b border-black dark:border-white dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Ingrese el área de salud">
                </td>
                <td class="w-1/4 p-2">
                    <label class="text-gray-700 dark:text-gray-300">Distrito de Salud:</label>
                    <input type="text" name="distrito_salud" value="{{ old('distrito_salud', $formulario->distrito_salud ?? '') }}" class="w-full border-none border-b border-black dark:border-white dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Ingrese el distrito de salud">
                </td>
                <td class="w-1/4 p-2">
                    <label class="text-gray-700 dark:text-gray-300">Municipio:</label>
                    <input type="text" name="municipio" value="{{ old('municipio', $formulario->municipio ?? '') }}" class="w-full border-none border-b border-black dark:border-white dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Ingrese el municipio">
                </td>
                <td class="w-1/4 p-2">
                    <label class="text-gray-700 dark:text-gray-300">Servicio de Salud:</label>
                    <input type="text" name="servicio_salud" value="{{ old('servicio_salud', $formulario->servicio_salud ?? '') }}" class="w-full border-none border-b border-black dark:border-white dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Ingrese el servicio de salud">
                </td>
            </tr>

            <tr>
                <td class="w-1/4 p-2">
                    <label class="text-gray-700 dark:text-gray-300">Responsable de la Información:</label>
                    <input type="text" name="responsable_informacion" value="{{ old('responsable_informacion', $formulario->responsable_informacion ?? '') }}" class="w-full border-none border-b border-black dark:border-white dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Ingrese el nombre del responsable">
                </td>
                <td class="w-1/4 p-2">
                    <label class="text-gray-700 dark:text-gray-300">Cargo:</label>
                    <input type="text" name="cargo_responsable" value="{{ old('cargo_responsable', $formulario->cargo_responsable ?? '') }}" class="w-full border-none border-b border-black dark:border-white dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Ingrese el cargo">
                </td>
                @if($mostrarMes)
                    <td class="w-1/6 p-2">
                        <label class="text-gray-700 dark:text-gray-300">Mes:</label>
                        <select name="mes" class="w-full border-none border-b border-black dark:border-white dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="" disabled selected>Seleccione el mes</option>
                            <option value="1">Enero</option>
                            <option value="2">Febrero</option>
                            <option value="3">Marzo</option>
                            <option value="4">Abril</option>
                            <option value="5">Mayo</option>
                            <option value="6">Junio</option>
                            <option value="7">Julio</option>
                            <option value="8">Agosto</option>
                            <option value="9">Septiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>
                        </select>
                    </td>
                @endif
                <td class="{{ $mostrarMes ? 'w-1/5' : 'w-1/4' }} p-2">
                    <label class="text-gray-700 dark:text-gray-300">Año:</label>
                    <input type="text" name="anio" value="{{ old('anio', $formulario->anio ?? '') }}" class="w-full border-none border-b border-black dark:border-white dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Ingrese el año">
                </td>
            </tr>
        </table>
    </div>
</div>
