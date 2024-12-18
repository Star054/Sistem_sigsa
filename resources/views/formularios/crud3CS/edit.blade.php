<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Formulario 3CS') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('formularios-3cs.update', $formulario->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="buscar" value="{{ request('buscar') }}">


                    <!-- Sección de Información del Formulario -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                                <label for="dia_consulta" class="block text-gray-700 dark:text-gray-400">Día de la Consulta</label>
                                <input type="text" name="dia_consulta" id="dia_consulta" value="{{ $formulario->dia_consulta }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                            </div>

                            <div class="mb-4">
                                <label for="no_historia_clinica" class="block text-gray-700 dark:text-gray-400">No. Historia clínica</label>
                                <input type="text" name="no_historia_clinica" id="no_historia_clinica" value="{{ $formulario->no_historia_clinica }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
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
                                <label for="comunidad_linguistica" class="block text-gray-700 dark:text-gray-400">Comunidad Lingüística</label>
                                <input type="text" name="comunidad_linguistica" id="comunidad_linguistica" value="{{ $formulario->comunidad_linguistica }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
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
                        </div>
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
                        </div>
                    </div>



                    <!-- Campos de Consulta -->
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Campos de Consulta</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            @foreach($formulario->consulta as $consulta)
                                <!-- Campos para cada consulta individual -->
                                <div class="mb-4">
                                    <label for="consulta_{{ $loop->index }}" class="block text-gray-700 dark:text-gray-400">Consulta</label>
                                    <select name="consulta[{{ $loop->index }}]" id="consulta_{{ $loop->index }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                                        <option value="" {{ is_null($consulta->consulta) ? 'selected' : '' }}>Sin seleccionar</option>
                                        <option value="1" {{ $consulta->consulta == 1 ? 'selected' : '' }}>Primera consulta</option>
                                        <option value="2" {{ $consulta->consulta == 2 ? 'selected' : '' }}>Reconsulta</option>
                                        <option value="3" {{ $consulta->consulta == 3 ? 'selected' : '' }}>Interconsulta</option>
                                        <option value="4" {{ $consulta->consulta == 4 ? 'selected' : '' }}>Emergencia</option>
                                    </select>
                                </div>

                                <!-- Control -->
                                <div class="mb-4">
                                    <label for="control_{{ $loop->index }}" class="block text-gray-700 dark:text-gray-400">Control</label>
                                    <select name="control[{{ $loop->index }}]" id="control_{{ $loop->index }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                                        <option value="" {{ is_null($consulta->control) ? 'selected' : '' }}>Sin seleccionar</option>
                                        <option value="0" {{ $consulta->control == 0 ? 'selected' : '' }}>No aplica</option>
                                        <option value="1" {{ $consulta->control == 1 ? 'selected' : '' }}>Prenatal</option>
                                        <option value="2" {{ $consulta->control == 2 ? 'selected' : '' }}>Puerperio</option>
                                    </select>
                                </div>

                                <!-- Semana de Gestación -->
                                <div class="mb-4">
                                    <label for="semana_gestacion_{{ $loop->index }}" class="block text-gray-700 dark:text-gray-400">Semana de Gestación</label>
                                    <input type="number" name="semana_gestacion[{{ $loop->index }}]" id="semana_gestacion_{{ $loop->index }}" value="{{ old('semana_gestacion.' . $loop->index, $consulta->semana_gestacion ?? '') }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                                </div>

                                <!-- Viene -->
                                <div class="mb-4">
                                    <label for="viene_{{ $loop->index }}" class="block text-gray-700 dark:text-gray-400">Viene</label>
                                    <select name="viene[{{ $loop->index }}]" id="viene_{{ $loop->index }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                                        <option value="" {{ is_null($consulta->viene) ? 'selected' : '' }}>Sin seleccionar</option>
                                        <option value="0" {{ $consulta->viene == 0 ? 'selected' : '' }}>No aplica</option>
                                        <option value="1" {{ $consulta->viene == 1 ? 'selected' : '' }}>Viene Referido</option>
                                        <option value="2" {{ $consulta->viene == 2 ? 'selected' : '' }}>Viene Contra Referido</option>
                                    </select>
                                </div>

                                <!-- Fue -->
                                <div class="mb-4">
                                    <label for="fue_{{ $loop->index }}" class="block text-gray-700 dark:text-gray-400">Fue</label>
                                    <select name="fue[{{ $loop->index }}]" id="fue_{{ $loop->index }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                                        <option value="" {{ is_null($consulta->fue) ? 'selected' : '' }}>Sin seleccionar</option>
                                        <option value="0" {{ $consulta->fue == 0 ? 'selected' : '' }}>No aplica</option>
                                        <option value="1" {{ $consulta->fue == 1 ? 'selected' : '' }}>Fue Referido</option>
                                        <option value="2" {{ $consulta->fue == 2 ? 'selected' : '' }}>Fue Contra Referido</option>
                                    </select>
                                </div>

                                <!-- Referido a -->
                                <div class="mb-4">
                                    <label for="referido_a_{{ $loop->index }}" class="block text-gray-700 dark:text-gray-400">Referido a</label>
                                    <input type="text" name="referido_a[{{ $loop->index }}]" id="referido_a_{{ $loop->index }}" value="{{ old('referido_a.' . $loop->index, $consulta->referido_a ?? '') }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                                </div>

                                <!-- Diagnóstico -->
                                <div class="mb-4">
                                    <label for="diagnostico_{{ $loop->index }}" class="block text-gray-700 dark:text-gray-400">Descripción de Diagnóstico/Control</label>
                                    <textarea name="diagnostico[{{ $loop->index }}]" id="diagnostico_{{ $loop->index }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">{{ old('diagnostico.' . $loop->index, $consulta->diagnostico ?? '') }}</textarea>
                                </div>

                                <!-- Código CIE-10 -->
                                <div class="mb-4">
                                    <label for="codigo_cie_{{ $loop->index }}" class="block text-gray-700 dark:text-gray-400">Código CIE-10</label>
                                    <input type="text" name="codigo_cie[{{ $loop->index }}]" id="codigo_cie_{{ $loop->index }}" value="{{ old('codigo_cie.' . $loop->index, $consulta->codigo_cie ?? '') }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                                </div>

                                <!-- Descripción (Vacuna) -->
                                <div class="mb-4">
                                    <label for="tratamiento_descripcion_{{ $loop->index }}" class="block text-gray-700 dark:text-gray-400">Descripción (Vacuna)</label>
                                    <select name="tratamiento_descripcion[{{ $loop->index }}]" id="tratamiento_descripcion_{{ $loop->index }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                                        <option value="">Sin seleccionar</option>
                                        @foreach($vacunas as $vacuna)
                                            <option value="{{ $vacuna->nombre_vacuna }}" {{ old('tratamiento_descripcion.' . $loop->index, $consulta->tratamiento_descripcion ?? '') == $vacuna->nombre_vacuna ? 'selected' : '' }}>
                                                {{ $vacuna->nombre_vacuna }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Presentación del Tratamiento -->
                                <div class="mb-4">
                                    <label for="tratamiento_presentacion_{{ $loop->index }}" class="block text-gray-700 dark:text-gray-400">Presentación del Tratamiento</label>
                                    <input type="text" name="tratamiento_presentacion[{{ $loop->index }}]" id="tratamiento_presentacion_{{ $loop->index }}" value="{{ old('tratamiento_presentacion.' . $loop->index, $consulta->tratamiento_presentacion ?? '') }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                                </div>

                                <!-- Cantidad Recetada -->
                                <div class="mb-4">
                                    <label for="cantidad_recetada_{{ $loop->index }}" class="block text-gray-700 dark:text-gray-400">Cantidad Recetada</label>
                                    <input type="number" name="cantidad_recetada[{{ $loop->index }}]" id="cantidad_recetada_{{ $loop->index }}" value="{{ old('cantidad_recetada.' . $loop->index, $consulta->cantidad_recetada ?? '') }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                                </div>

                                <!-- Lugar de Notificación -->
                                <div class="mb-4">
                                    <label for="notificacion_lugar_{{ $loop->index }}" class="block text-gray-700 dark:text-gray-400">Lugar de Notificación</label>
                                    <select name="notificacion_lugar[{{ $loop->index }}]" id="notificacion_lugar_{{ $loop->index }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                                        <option value="" {{ is_null($consulta->notificacion_lugar) ? 'selected' : '' }}>Sin seleccionar</option>
                                        <option value="0" {{ $consulta->notificacion_lugar == 0 ? 'selected' : '' }}>No aplica</option>
                                        <option value="1" {{ $consulta->notificacion_lugar == 1 ? 'selected' : '' }}>Ministerio Público</option>
                                        <option value="2" {{ $consulta->notificacion_lugar == 2 ? 'selected' : '' }}>Procuraduría General de la Nación</option>
                                        <option value="3" {{ $consulta->notificacion_lugar == 3 ? 'selected' : '' }}>Policía Nacional Civil</option>
                                    </select>
                                </div>

                                <!-- Número de Notificación -->
                                <div class="mb-4">
                                    <label for="notificacion_numero_{{ $loop->index }}" class="block text-gray-700 dark:text-gray-400">Número de Notificación</label>
                                    <input type="text" name="notificacion_numero[{{ $loop->index }}]" id="notificacion_numero_{{ $loop->index }}" value="{{ old('notificacion_numero.' . $loop->index, $consulta->notificacion_numero ?? '') }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                                </div>

                                <!-- Nombre del Acompañante -->
                                <div class="mb-4">
                                    <label for="nombre_acompanante_{{ $loop->index }}" class="block text-gray-700 dark:text-gray-400">Nombre del Acompañante</label>
                                    <input type="text" name="nombre_acompanante[{{ $loop->index }}]" id="nombre_acompanante_{{ $loop->index }}" value="{{ old('nombre_acompanante.' . $loop->index, $consulta->nombre_acompanante ?? '') }}" class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 p-2 rounded-md w-full">
                                </div>
                            @endforeach


                                <div class="mt-8">
                                    <x-primary-button type="submit" class="bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-opacity-50 text-white font-semibold rounded-lg py-2 px-4 transition-all duration-300 ease-in-out">
                                        {{ __('Actualizar') }}
                                    </x-primary-button>
                                </div>
                        <form/>
                        </div>
                    </div>


                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
