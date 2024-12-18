@props(['mostrarEmbarazada' => true])

<div class="container mx-auto px-4 py-6">
    <!-- Encabezado del Formulario -->
    <div class="w-3/4 overflow-x-auto">
        <table class="able-auto w-1/2 border-collapse mb-6 border border-black dark:border-white">
            <thead>
            <tr>
                <th colspan="2" class="border border-black dark:border-white p-2 text-center text-black dark:text-white">
                    Residencia
                </th>
                <th rowspan="2" class="border border-black dark:border-white p-2 text-center text-black dark:text-white">
                    9/ Agrícola Migrante<br>
                </th>
                <!-- Solo mostrar la columna "Embarazada" si está habilitada -->
                @if($mostrarEmbarazada)
                    <th rowspan="2" class="border border-black dark:border-white p-2 text-center text-black dark:text-white">
                        10/ Embarazada?<br>
                    </th>
                @endif
            </tr>
            <tr>
                <th class="border border-black dark:border-white p-2 text-black dark:text-white">
                    Comunidad y/o dirección exacta
                </th>
                <th class="border border-black dark:border-white p-2 text-black dark:text-white">
                    Municipio
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <!-- Campo de entrada para Comunidad y/o dirección exacta -->
                <td class="border border-black dark:border-white p-0">
                    <input type="text" name="comunidad_direccion" id="comunidad_direccion"
                           class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                           value="{{ old('comunidad_direccion', $formulario->residencia->comunidad_direccion ?? '') }}">
                    @error('comunidad_direccion')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </td>

                <!-- Campo de entrada para Municipio -->
                <td class="border border-black dark:border-white p-0">
                    <input type="text" name="municipio_residencia" id="municipio_residencia"
                           class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                           value="{{ old('municipio_residencia', $formulario->residencia->municipio_residencia ?? '') }}">
                    @error('municipio_residencia')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </td>

                <!-- Campo de entrada para Agrícola Migrante -->
                <td class="border border-black dark:border-white p-0">
                    <input type="text" name="agricola_migrante" id="agricola_migrante"
                           class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                           value="{{ old('agricola_migrante', $formulario->residencia->agricola_migrante ?? '') }}"
                           placeholder="Ingrese 'X' si es aplicable">
                    @error('agricola_migrante')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </td>

                <!-- Campo de entrada para Embarazada -->
                @if($mostrarEmbarazada)
                    <td class="border border-black dark:border-white p-0">
                        <input type="text" name="embarazada" id="embarazada"
                               class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                               value="{{ old('embarazada', $formulario->residencia->embarazada ?? '') }}"
                               placeholder="Ingrese 'X' si es aplicable">
                        @error('embarazada')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </td>
                @endif

            </tr>
            </tbody>
        </table>
    </div>
</div>
