@props([
    'mostrarNoOrden' => true,
    'mostrarDiaConsulta' => false,
    'mostrarHistoriaClinica' => false,
    'mostrarDiscapacidad' => true
])

<div class="container mx-auto px-4 py-6">
    <!-- Tabla de datos del paciente -->
    <div class="overflow-x-auto">
        <table class="table-auto h-8 border-collapse mb-6 border border-black dark:border-white">
            <thead>
            <tr>
                @if($mostrarNoOrden)
                    <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">No. Orden</th>
                @endif
                @if($mostrarDiaConsulta)
                    <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">Día de la Consulta</th>
                @endif
                @if($mostrarHistoriaClinica)
                    <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">No. Historia Clínica</th>
                @endif
                <th class="w-full border border-black dark:border-white p-5 text-center text-gray-900 dark:text-gray-100">
                    Nombres y apellidos del paciente
                </th>
                <th class="border border-black dark:border-white p-4 text-center text-gray-900 dark:text-gray-100">CUI Código Único de Identificación</th>
                <th class="border border-black dark:border-white p-4 text-center text-gray-900 dark:text-gray-100">1/ Sexo</th>
                <th class="border border-black dark:border-white p-4 text-center text-gray-900 dark:text-gray-100">2/ Pueblo</th>
                <th class="border border-black dark:border-white p-4 text-center text-gray-900 dark:text-gray-100">3/ Fecha de nacimiento o edad</th>
                    <th class="border border-black dark:border-white p-3 text-center text-gray-900 dark:text-gray-100">4/ Comunidad lingüística</th>
                    @if($mostrarDiscapacidad)
                        <th class="border border-black dark:border-white p-3 text-center text-gray-900 dark:text-gray-100">5/ Discapacidad</th>
                    @endif

                <th class="border border-black dark:border-white p-3 text-center text-gray-900 dark:text-gray-100">6/ Orientación Sexual</th>
                <th class="border border-black dark:border-white p-3 text-center text-gray-900 dark:text-gray-100">7/ Escolaridad</th>
                <th class="border border-black dark:border-white p-4 text-center text-gray-900 dark:text-gray-100">8/ Profesión u oficio</th>

            </tr>
            </thead>
            <tbody>
            <tr>
                @if($mostrarNoOrden)
                    <td class="border border-black dark:border-white p-0">
                        <input type="text" name="no_orden"
                               class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                        @error('no_orden')
                        <div class="text-red-500 text-xs italic mt-1">{{ $message }}</div>
                        @enderror
                    </td>
                @endif

                @if($mostrarDiaConsulta)
                    <td class="border border-black dark:border-white p-0">
                        <input type="date" name="dia_consulta"
                               class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                        @error('dia_consulta')
                        <div class="text-red-500 text-xs italic mt-1">{{ $message }}</div>
                        @enderror
                    </td>
                @endif

                @if($mostrarHistoriaClinica)
                    <td class="border border-black dark:border-white p-0">
                        <textarea name="no_historia_clinica"
                                  class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                                  rows="1"
                                  oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                        @error('no_historia_clinica')
                        <div class="text-red-500 text-xs italic mt-1">{{ $message }}</div>
                        @enderror
                    </td>
                @endif

                <!-- Nombres y apellidos del paciente -->
                <td class="border border-black dark:border-white p-0">
                    <input type="text" name="nombre_paciente" maxlength="40"
                           class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                    @error('nombre_paciente')
                    <div class="text-red-500 text-xs italic mt-1">{{ $message }}</div>
                    @enderror
                </td>

                <!-- CUI Código Único de Identificación -->
                <td class="border border-black dark:border-white p-0">
                    <input type="text" name="cui" maxlength="13" pattern="\d{13}"
                           class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                    @error('cui')
                    <div class="text-red-500 text-xs italic mt-1">{{ $message }}</div>
                    @enderror
                </td>

                <!-- Sexo -->
                <td class="border border-black dark:border-white p-0">
                    <select name="sexo" class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                        <option value="">Seleccione el sexo</option>
                        <option value="M">M</option>
                        <option value="F">F</option>
                    </select>
                </td>

                    <!-- Pueblo -->
                    <td class="border border-black dark:border-white p-0">
                        <select name="pueblo" class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                            <option value="">Seleccione</option>
                            <option value="1" {{ old('pueblo', $formulario->pueblo ?? '') == '1' ? 'selected' : '' }}>1 - Mestizo, Ladino</option>
                            <option value="2" {{ old('pueblo', $formulario->pueblo ?? '') == '2' ? 'selected' : '' }}>2 - Maya</option>
                            <option value="3" {{ old('pueblo', $formulario->pueblo ?? '') == '3' ? 'selected' : '' }}>3 - Garífuna</option>
                            <option value="4" {{ old('pueblo', $formulario->pueblo ?? '') == '4' ? 'selected' : '' }}>4 - Xinca</option>
                            <option value="5" {{ old('pueblo', $formulario->pueblo ?? '') == '5' ? 'selected' : '' }}>5 - Otros</option>
                            <option value="6" {{ old('pueblo', $formulario->pueblo ?? '') == '6' ? 'selected' : '' }}>6 - No indica</option>
                        </select>
                    </td>

                    <!-- Fecha de nacimiento o edad -->
                <td class="w-3/4 border border-black dark:border-white p-0">
                    <input type="date" name="fecha_nacimiento"
                           class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                    @error('fecha_nacimiento')
                    <div class="text-red-500 text-xs italic mt-1">{{ $message }}</div>
                    @enderror
                </td>

                <!-- Comunidad lingüística -->
                <td class="border border-black dark:border-white p-0">
                    <select name="comunidad_linguistica" class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                        <option value="">Seleccione</option>
                        <option value="1">1 - Achi´</option>
                        <option value="2">2 - Akateka</option>
                        <option value="3">3 - Awakateka</option>
                    </select>
                </td>

                <!-- Orientación Sexual -->
                <td class="border border-black dark:border-white p-0">
                    <select name="orientacion_sexual" class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                        <option value="">Seleccione</option>
                        <option value="0">0 - No aplica</option>
                        <option value="1">1 - Heterosexual</option>
                        <option value="2">2 - Bisexual</option>
                        <option value="3">3 - Homosexual</option>
                        <option value="4">4 - Trans</option>
                        <option value="5">5 - Otro</option>
                    </select>
                </td>

                <!-- Escolaridad -->
                <td class="border border-black dark:border-white p-0">
                    <select name="escolaridad" class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                        <option value="">Seleccione</option>
                        <option value="0">0 - No aplica</option>
                        <option value="1">1 - Pre Primaria</option>
                        <option value="2">2 - Primaria</option>
                        <option value="3">3 - Básicos</option>
                        <option value="4">4 - Diversificado</option>
                        <option value="5">5 - Universidad</option>
                        <option value="6">6 - Ninguno</option>
                        <option value="7">7 - Otro</option>
                    </select>
                </td>

                <!-- Profesión u oficio -->
                <td class="border border-black dark:border-white p-0">
                    <select name="profesion_oficio" class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                        <option value="">Seleccione</option>
                        <option value="0">0 - No aplica</option>
                        <option value="1">1 - Ama de Casa</option>
                        <option value="2">2 - Mujer Trabajadora Sexual</option>
                        <option value="3">3 - Hombre trabajador sexual</option>
                        <option value="4">4 - Persona Privada de Libertad</option>
                        <option value="5">5 - Joven en riesgo social</option>
                        <option value="6">6 - Uniformados</option>
                        <option value="7">7 - Migrantes</option>
                        <option value="8">8 - Otros</option>
                    </select>
                </td>

                <!-- Discapacidad -->
                @if($mostrarDiscapacidad)
                    <td class="border border-black dark:border-white p-0">
                        <select name="discapacidad" class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                            <option value="">Seleccione</option>
                            <option value="0">0 - No aplica</option>
                            <option value="1">1 - Física</option>
                            <option value="2">2 - Mental</option>
                            <option value="3">3 - Visual</option>
                            <option value="4">4 - Auditiva</option>
                            <option value="5">5 - Otro</option>
                        </select>
                    </td>
                @endif
            </tr>
            </tbody>
        </table>
    </div>
</div>
