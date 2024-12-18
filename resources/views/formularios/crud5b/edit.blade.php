<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Formulario FOR-SIGSA-5b') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Formulario de edición -->

                <form action="{{ route('for-sigsa-5b.update', ['for_sigsa_5b' => $formulario->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Campo oculto para enviar el término de búsqueda -->
                    <input type="hidden" name="buscar" value="{{ request('buscar') }}"> <!-- Asegúrate de que esté correctamente cerrado -->

                    <!-- Otros campos... -->
                    <!-- Sección de Información del Formulario -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Select de vacuna -->
                        <div class="mb-4">
                            <label for="vacuna" class="block text-gray-700 dark:text-gray-400">Vacuna</label>
                            <select name="vacuna" id="vacuna" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                                @foreach ($vacunas as $vacuna)
                                    <option value="{{ $vacuna->nombre_vacuna }}" {{ $formulario->vacuna === $vacuna->nombre_vacuna ? 'selected' : '' }}>
                                        {{ $vacuna->nombre_vacuna }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="area_salud" class="block text-gray-700 dark:text-gray-400">Área de Salud</label>
                            <input type="text" name="area_salud" id="area_salud" value="{{ $formulario->area_salud }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                        </div>

                        <div class="mb-4">
                            <label for="distrito_salud" class="block text-gray-700 dark:text-gray-400">Distrito de Salud</label>
                            <input type="text" name="distrito_salud" id="distrito_salud" value="{{ $formulario->distrito_salud }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                        </div>

                        <div class="mb-4">
                            <label for="municipio" class="block text-gray-700 dark:text-gray-400">Municipio</label>
                            <input type="text" name="municipio" id="municipio" value="{{ $formulario->municipio }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                        </div>

                        <div class="mb-4">
                            <label for="servicio_salud" class="block text-gray-700 dark:text-gray-400">Servicio de Salud</label>
                            <input type="text" name="servicio_salud" id="servicio_salud" value="{{ $formulario->servicio_salud }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                        </div>

                        <div class="mb-4">
                            <label for="responsable_informacion" class="block text-gray-700 dark:text-gray-400">Responsable de la Información</label>
                            <input type="text" name="responsable_informacion" id="responsable_informacion" value="{{ $formulario->responsable_informacion }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                        </div>

                        <div class="mb-4">
                            <label for="cargo_responsable" class="block text-gray-700 dark:text-gray-400">Cargo del Responsable</label>
                            <input type="text" name="cargo_responsable" id="cargo_responsable" value="{{ $formulario->cargo_responsable }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                        </div>

                        <div class="mb-4">
                            <label for="anio" class="block text-gray-700 dark:text-gray-400">Año</label>
                            <input type="text" name="anio" id="anio" value="{{ $formulario->anio }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                        </div>
                    </div>

                    <!-- Sección de Datos del Paciente -->

                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Datos del Paciente</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4">
                                <label for="no_orden" class="block text-gray-700 dark:text-gray-400">No. Orden</label>
                                <input type="text" name="no_orden" id="no_orden" value="{{ $formulario->no_orden }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                            </div>
                            <div class="mb-4">
                                <label for="nombre_paciente" class="block text-gray-700 dark:text-gray-400">Nombre del Paciente</label>
                                <input type="text" name="nombre_paciente" id="nombre_paciente" value="{{ $formulario->nombre_paciente }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                            </div>

                            <div class="mb-4">
                                <label for="cui" class="block text-gray-700 dark:text-gray-400">CUI</label>
                                <input type="text" name="cui" id="cui" value="{{ $formulario->cui }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                            </div>

                            <div class="mb-4">
                                <label for="fecha_nacimiento" class="block text-gray-700 dark:text-gray-400">Fecha de Nacimiento</label>
                                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ $formulario->fecha_nacimiento }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                            </div>

                            <div class="mb-4">
                                <label for="discapacidad" class="block text-gray-700 dark:text-gray-400">Discapacidad</label>
                                <select name="discapacidad" id="discapacidad" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                                    <option value="" {{ is_null($formulario->discapacidad) ? 'selected' : '' }}>Seleccione</option>
                                    <option value="0" {{ $formulario->discapacidad === 0 ? 'selected' : '' }}>No aplica</option>
                                    <option value="1" {{ $formulario->discapacidad == 1 ? 'selected' : '' }}>Física</option>
                                    <option value="2" {{ $formulario->discapacidad == 2 ? 'selected' : '' }}>Mental</option>
                                    <option value="3" {{ $formulario->discapacidad == 3 ? 'selected' : '' }}>Visual</option>
                                    <option value="4" {{ $formulario->discapacidad == 4 ? 'selected' : '' }}>Auditiva</option>
                                    <option value="5" {{ $formulario->discapacidad == 5 ? 'selected' : '' }}>Otro</option>

                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="sexo" class="block text-gray-700 dark:text-gray-400">Sexo</label>
                                <select name="sexo" id="sexo" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                                    <option value="" {{ is_null($formulario->sexo) ? 'selected' : '' }}>Seleccione el sexo</option>
                                    <option value="M" {{ $formulario->sexo === 'M' ? 'selected' : '' }}>Masculino</option>
                                    <option value="F" {{ $formulario->sexo === 'F' ? 'selected' : '' }}>Femenino</option>
                                </select>
                            </div>


                            <div class="mb-4">
                                <label for="pueblo" class="block text-gray-700 dark:text-gray-400">Pueblo</label>
                                <select name="pueblo" id="pueblo" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                                    <option value="" {{ is_null($formulario->pueblo) ? 'selected' : '' }}>Seleccione</option>
                                    <option value="1" {{ $formulario->pueblo == 1 ? 'selected' : '' }}>Mestizo, Ladino</option>
                                    <option value="2" {{ $formulario->pueblo == 2 ? 'selected' : '' }}>Maya</option>
                                    <option value="3" {{ $formulario->pueblo == 3 ? 'selected' : '' }}>Garífuna</option>
                                    <option value="4" {{ $formulario->pueblo == 4 ? 'selected' : '' }}>Xinca</option>
                                    <option value="5" {{ $formulario->pueblo == 5 ? 'selected' : '' }}>Otro</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="comunidad_linguistica" class="block text-gray-700 dark:text-gray-400">Comunidad Lingüística</label>
                                <input type="text" name="comunidad_linguistica" id="comunidad_linguistica" value="{{ $formulario->comunidad_linguistica }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                            </div>

                            <div class="mb-4">
                                <label for="orientacion_sexual" class="block text-gray-700 dark:text-gray-400">Orientación Sexual</label>
                                <select name="orientacion_sexual" id="orientacion_sexual" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                                    <option value="" {{ is_null($formulario->orientacion_sexual) ? 'selected' : '' }}>Seleccione</option>
                                    <option value="0" {{ strval($formulario->orientacion_sexual) === '0' ? 'selected' : '' }}>No aplica</option>
                                    <option value="1" {{ strval($formulario->orientacion_sexual) === '1' ? 'selected' : '' }}>Heterosexual</option>
                                    <option value="2" {{ strval($formulario->orientacion_sexual) === '2' ? 'selected' : '' }}>Bisexual</option>
                                    <option value="3" {{ strval($formulario->orientacion_sexual) === '3' ? 'selected' : '' }}>Homosexual</option>
                                    <option value="4" {{ strval($formulario->orientacion_sexual) === '4' ? 'selected' : '' }}>Trans</option>
                                    <option value="5" {{ strval($formulario->orientacion_sexual) === '5' ? 'selected' : '' }}>Otro</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="escolaridad" class="block text-gray-700 dark:text-gray-400">Escolaridad</label>
                                <select name="escolaridad" id="escolaridad" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                                    <option value="" {{ is_null($formulario->escolaridad) ? 'selected' : '' }}>Seleccione</option>
                                    <option value="0" {{ $formulario->escolaridad === 0 ? 'selected' : '' }}>No aplica</option>
                                    <option value="1" {{ $formulario->escolaridad === 1 ? 'selected' : '' }}>Pre Primaria</option>
                                    <option value="2" {{ $formulario->escolaridad === 2 ? 'selected' : '' }}>Primaria</option>
                                    <option value="3" {{ $formulario->escolaridad === 3 ? 'selected' : '' }}>Básicos</option>
                                    <option value="4" {{ $formulario->escolaridad === 4 ? 'selected' : '' }}>Diversificado</option>
                                    <option value="5" {{ $formulario->escolaridad === 5 ? 'selected' : '' }}>Universidad</option>
                                    <option value="6" {{ $formulario->escolaridad === 6 ? 'selected' : '' }}>Ninguno</option>
                                    <option value="7" {{ $formulario->escolaridad === 7 ? 'selected' : '' }}>Otro</option>
                                </select>
                            </div>



                            <div class="mb-4">
                                <label for="profesion_oficio" class="block text-gray-700 dark:text-gray-400">Profesión u Oficio</label>
                                <select name="profesion_oficio" id="profesion_oficio" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                                    <option value="" {{ is_null($formulario->profesion_oficio) ? 'selected' : '' }}>Seleccione</option>
                                    <option value="0" {{ $formulario->profesion_oficio === 0 ? 'selected' : '' }}>No aplica</option>
                                    <option value="1" {{ $formulario->profesion_oficio === 1 ? 'selected' : '' }}>Ama de Casa</option>
                                    <option value="2" {{ $formulario->profesion_oficio === 2 ? 'selected' : '' }}>Mujer Trabajadora Sexual</option>
                                    <option value="3" {{ $formulario->profesion_oficio === 3 ? 'selected' : '' }}>Hombre trabajador sexual</option>
                                    <option value="4" {{ $formulario->profesion_oficio === 4 ? 'selected' : '' }}>Persona Privada de Libertad</option>
                                    <option value="5" {{ $formulario->profesion_oficio === 5 ? 'selected' : '' }}>Joven en riesgo social</option>
                                    <option value="6" {{ $formulario->profesion_oficio === 6 ? 'selected' : '' }}>Uniformados</option>
                                    <option value="7" {{ $formulario->profesion_oficio === 7 ? 'selected' : '' }}>Migrantes</option>
                                    <option value="8" {{ $formulario->profesion_oficio === 8 ? 'selected' : '' }}>Otros</option>
                                </select>
                            </div>





                        </div>

                    <!-- Sección de Residencia -->
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Datos de Residencia</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4">
                                <label for="comunidad_direccion" class="block text-gray-700 dark:text-gray-400">Comunidad Dirección</label>
                                <input type="text" name="comunidad_direccion" id="comunidad_direccion"
                                       value="{{ old('comunidad_direccion', $formulario->residencia->comunidad_direccion ?? '') }}"
                                       class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                            </div>

                            <div class="mb-4">
                                <label for="municipio_residencia" class="block text-gray-700 dark:text-gray-400">Municipio Residencia</label>
                                <input type="text" name="municipio_residencia" id="municipio_residencia"
                                       value="{{ old('municipio_residencia', $formulario->residencia->municipio_residencia ?? '') }}"
                                       class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                            </div>

                            <div class="mb-4">
                                <label for="agricola_migrante" class="block text-gray-700 dark:text-gray-400">Agrícola Migrante</label>
                                <input type="text" name="agricola_migrante" id="agricola_migrante"
                                       value="{{ $formulario->residencia->agricola_migrante ?? '' }}"
                                       class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full"
                                       placeholder="Ingrese 'X' si es aplicable">
                            </div>

                            <div class="mb-4">
                                <label for="embarazada" class="block text-gray-700 dark:text-gray-400">Embarazada</label>
                                <input type="text" name="embarazada" id="embarazada"
                                       value="{{ $formulario->residencia->embarazada ?? '' }}"
                                       class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full"
                                       placeholder="Ingrese 'X' si es aplicable">
                            </div>
                        </div>

                        </div>
                    </div>


                    <!-- Sección de Vacunas para Mujer de 15 a 49 años -->
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Mujer de 15-49</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach (['1a', '2a', '3a', 'r1', 'r2'] as $dosis)
                                <div class="mb-4">
                                    <label for="vacuna_mujer_15_49_{{ $dosis }}" class="block text-gray-700 dark:text-gray-400">Vacuna Mujer 15-49 ({{ $dosis }})</label>
                                    <input type="date" name="vacuna_mujer_15_49[{{ $dosis }}]" id="vacuna_mujer_15_49_{{ $dosis }}"
                                           value="{{ old('vacuna_mujer_15_49.'.$dosis, $formulario->mujer15a49yOtrosGrupos->where('tipo_dosis', $dosis)->where('grupo', 'mujer_15_49')->first()->fecha_vacunacion ?? '') }}"
                                           class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Sección de Vacunas para Otros Grupos -->
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Otros Grupos</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach (['1a', '2a', '3a', 'r1', 'r2'] as $dosis)
                                <div class="mb-4">
                                    <label for="vacuna_otros_grupos_{{ $dosis }}" class="block text-gray-700 dark:text-gray-400">Vacuna Otros Grupos ({{ $dosis }})</label>
                                    <input type="date" name="vacuna_otros_grupos[{{ $dosis }}]" id="vacuna_otros_grupos_{{ $dosis }}"
                                           value="{{ old('vacuna_otros_grupos.'.$dosis, $formulario->mujer15a49yOtrosGrupos->where('tipo_dosis', $dosis)->where('grupo', 'otros_grupos')->first()->fecha_vacunacion ?? '') }}"
                                           class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Botón para actualizar -->
                    <div class="mt-8">
                        <x-primary-button type="submit" class="bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-opacity-50 text-white font-semibold rounded-lg py-2 px-4 transition-all duration-300 ease-in-out">
                            {{ __('Actualizar') }}
                        </x-primary-button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
