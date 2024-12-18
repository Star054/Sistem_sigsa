<?php

namespace App\Http\Controllers;

use App\Models\FormularioSIGSA5b;
use Illuminate\Http\Request;
use App\Models\Residencia;
use App\Models\Vacuna;
use App\Models\TipoFormulario;
use App\Models\Mujer15a49yOtrosGrupos;
use Carbon\Carbon;


class FormularioSIGSAController extends Controller
{

    public function index(Request $request)
    {
        // Obtener el mes y el año de la solicitud, o usar los valores actuales por defecto
        $selectedMonth = $request->input('mes', Carbon::now()->month);
        $selectedYear = $request->input('año', Carbon::now()->year);

        // Recuperar formularios con el tipo de formulario "FOR-SIGSA-5b"
        $formulariosFiltrados = FormularioSIGSA5b::whereHas('tipoFormularios', function ($query) {
            $query->where('codigo_formulario', 'FOR-SIGSA-5b');
        })
            ->where(function($query) use ($selectedMonth, $selectedYear) {
                // Filtrar por la fecha de creación del formulario
                $query->whereMonth('created_at', $selectedMonth)
                    ->whereYear('created_at', $selectedYear)
                    ->orWhereHas('mujer15a49yOtrosGrupos', function ($query) use ($selectedMonth, $selectedYear) {
                        // Filtrar por la fecha de vacunación en mujer15a49yOtrosGrupos
                        $query->whereMonth('fecha_vacunacion', $selectedMonth)
                            ->whereYear('fecha_vacunacion', $selectedYear);
                    });
            })
            ->get(); // Recuperar los formularios filtrados

        // Retornar la vista con los formularios filtrados
        return view('formularios.crud5b.index', compact('formulariosFiltrados', 'selectedMonth', 'selectedYear'));
    }




    public function resultados(Request $request)
    {
        $tipoFormulario = $request->input('tipo_formulario');
        $vacuna = $request->input('vacuna');
        $mes = $request->input('mes');

        // Parsear el mes para obtener el número y el año
        $mesSeleccionado = Carbon::parse($mes)->month;
        $anioSeleccionado = Carbon::parse($mes)->year;

        // Crear la consulta base dependiendo del tipo de formulario
        $pacientesQuery = FormularioSIGSA5b::query(); // Cambia el modelo según corresponda
        if ($tipoFormulario === 'SIGSA5b') {
            $pacientesQuery->with(['vacuna', 'residencia', 'mujer15a49yOtrosGrupos']);
        } elseif ($tipoFormulario === 'SIGSA5bA') {
            $pacientesQuery = FormularioSIGSA5b::query()->with(['vacuna']);
        } elseif ($tipoFormulario === 'SIGSA3CS') {
            $pacientesQuery = FormularioSIGSA5b::query()->with(['consulta']);
        }

        // Aplicar filtros
        $pacientesQuery->when($vacuna, function ($query, $vacuna) {
            $query->whereHas('vacuna', function ($q) use ($vacuna) {
                $q->where('nombre_vacuna', $vacuna);
            });
        });

        $pacientesQuery->whereMonth('fecha_vacunacion', $mesSeleccionado)
            ->whereYear('fecha_vacunacion', $anioSeleccionado);

        // Obtener los pacientes filtrados
        $pacientes = $pacientesQuery->get();

        // Pasar los resultados a la vista
        return view('consultas.resultados', compact('pacientes', 'tipoFormulario', 'vacuna', 'mes'));
    }


    public function destroy($id)
    {

        $formulario = FormularioSIGSA5b::findOrFail($id);
        $formulario->delete();
        return redirect()->route('for-sigsa-5b.index')->with('success', 'Formulario eliminado correctamente.');
    }


    public function show($id)
    {
        $formulario = FormularioSIGSA5b::with(['residencia', 'mujer15a49yOtrosGrupos'])->findOrFail($id);
        return view('formularios.crud5b.show', compact('formulario'));
    }

    public function create()
    {
        $vacunas = Vacuna::all();
        return view('formularios.formulario-for-sigsa-5b', compact('vacunas'));
    }

    public function store(Request $request)
    {
//
//        dd($request->all());  // Depurar todos los datos enviados desde el formulario

        $validated = $request->validate([
            'vacuna' => 'required|string|exists:vacunas,nombre_vacuna',
            'nombre_paciente' => 'required|string',
            'codigo_formulario' => 'required|string',
            'area_salud' => 'nullable|string',
            'distrito_salud' => 'nullable|string',
            'municipio' => 'nullable|string',
            'servicio_salud' => 'nullable|string',
            'responsable_informacion' => 'nullable|string',
            'cargo_responsable' => 'nullable|string',
            'anio' => 'nullable|string',
            'no_orden' => 'nullable|integer',
            'cui' => 'nullable|string',
            'fecha_nacimiento' => 'nullable|date',
            'sexo' => 'nullable|string|in:M,F', // Solo puede ser M o F
            'pueblo' => 'nullable|integer|in:1,2,3,4,5,6', // Validar pueblo según la lista
            'comunidad_linguistica' => 'nullable|integer|in:1,2,3,...,23', // Comunidades lingüísticas validas
            'escolaridad' => 'nullable|integer|in:0,1,2,3,4,5,6,7', // Escolaridad con los valores asignados
            'profesion_oficio' => 'nullable|integer|in:0,1,2,3,4,5,6,7,8', // Profesión u oficio
            'discapacidad' => 'nullable|integer|in:0,1,2,3,4,5', // Discapacidad de 0 a 5
            'orientacion_sexual' => 'nullable|integer|in:0,1,2,3,4,5', // Orientación sexual validada
            'dia_consulta' => 'nullable|date',
            'no_historia_clinica' => 'nullable|string',
            'comunidad_direccion' => 'nullable|string',
            'municipio_residencia' => 'nullable|string',
            'agricola_migrante' => 'nullable|string',
            'embarazada' => 'nullable|string',


            'mujer_15_49' => 'nullable|array',
            'mujer_15_49.*' => 'nullable|date',

            'otros_grupos' => 'nullable|array',
            'otros_grupos.*' => 'nullable|date',
        ]);


        // Si se proporciona el CUI, buscar por CUI y vacuna
        if (!empty($validated['cui'])) {
            $pacienteExistente = FormularioSIGSA5b::where('cui', $validated['cui'])
                ->where('vacuna', $validated['vacuna']) // Verificar la misma vacuna
                ->first();
        } else {
            // Si no se proporciona el CUI, buscar por nombre del paciente y vacuna
            $pacienteExistente = FormularioSIGSA5b::where('nombre_paciente', $validated['nombre_paciente'])
                ->where('vacuna', $validated['vacuna']) // Verificar la misma vacuna
                ->first();
        }

        if ($pacienteExistente) {
            // Si ya existe, redirigir con un mensaje de alerta
            return redirect()->back()->with('alert', 'Este paciente ya ha recibido esta vacuna. Si deseas agregar una segunda dosis o refuerzo, edita el registro existente.');
        }



        $tipoFormulario = TipoFormulario::firstOrCreate([
            'codigo_formulario' => $validated['codigo_formulario'],
        ]);

        $vacuna = Vacuna::where('nombre_vacuna', $validated['vacuna'])->firstOrFail();

        $formulario = FormularioSIGSA5b::create([
            'vacuna' => $vacuna->nombre_vacuna,
            'area_salud' => $validated['area_salud'],
            'distrito_salud' => $validated['distrito_salud'],
            'municipio' => $validated['municipio'],
            'servicio_salud' => $validated['servicio_salud'],
            'responsable_informacion' => $validated['responsable_informacion'],
            'cargo_responsable' => $validated['cargo_responsable'],
            'anio' => $validated['anio'],
            'no_orden' => $validated['no_orden'] ?? null,
            'cui' => $validated['cui'] ?? null,
            'nombre_paciente' => $validated['nombre_paciente'],
            'sexo' => $validated['sexo'] ?? null,
            'pueblo' => $validated['pueblo'] ?? null,
            'fecha_nacimiento' => $validated['fecha_nacimiento'] ?? null,
            'comunidad_linguistica' => $validated['comunidad_linguistica'] ?? null,
            'escolaridad' => $validated['escolaridad'] !== '' ? $validated['escolaridad'] : null,

            'profesion_oficio' => $validated['profesion_oficio'] ?? null,
            'discapacidad' => $validated['discapacidad'] ?? null,

            'comunidad_direccion' => 'nullable|string',
            'municipio_residencia' => 'nullable|string',
            'agricola_migrante' => 'nullable|string',
            'embarazada' => 'nullable|string',
        ]);

        // Relacionar el formulario con el tipo de formulario
        $formulario->tipoFormularios()->attach($tipoFormulario->id);

        // Guardar los datos de residencia
        $formulario->residencia()->create([
            'comunidad_direccion' => $validated['comunidad_direccion'],
            'municipio_residencia' => $validated['municipio_residencia'],
            'agricola_migrante' => $validated['agricola_migrante'],
            'embarazada' => $validated['embarazada'],
        ]);

        // Almacenar las dosis de vacunación para mujeres de 15 a 49 años
        foreach ($request->input('mujer_15_49', []) as $tipoDosis => $fechaVacunacion) {
            if ($fechaVacunacion) {
                Mujer15a49yOtrosGrupos::create([
                    'formulario_base_id' => $formulario->id,
                    'grupo' => 'mujer_15_49',
                    'fecha_vacunacion' => $fechaVacunacion,
                    'tipo_dosis' => $tipoDosis,
                ]);
            }
        }

        // Almacenar las dosis de vacunación para otros grupos
        foreach ($request->input('otros_grupos', []) as $tipoDosis => $fechaVacunacion) {
            if ($fechaVacunacion) {
                Mujer15a49yOtrosGrupos::create([
                    'formulario_base_id' => $formulario->id,
                    'grupo' => 'otros_grupos',
                    'fecha_vacunacion' => $fechaVacunacion,
                    'tipo_dosis' => $tipoDosis,
                ]);
            }
        }

        session()->flash('status', 'form-saved');
//        return redirect()->route('formulario.exitoso')->with('status', 'Formulario guardado exitosamente');
        return redirect()->route('for-sigsa-5b.create');
    }


    public function edit($id)
    {
        // Cargar el formulario junto con las relaciones
        $formulario = FormularioSIGSA5b::with('mujer15a49yOtrosGrupos', 'residencia')->findOrFail($id);

        // Obtener las vacunas disponibles
        $vacunas = Vacuna::all();

        return view('formularios.crud5b.edit', compact('formulario', 'vacunas'));
    }



    public function update(Request $request, $id)
    {


        // Validar los datos del formulario
        $validated = $request->validate([
            'vacuna' => 'nullable|string|exists:vacunas,nombre_vacuna', // No requerido en la actualización
            'nombre_paciente' => 'required|string|max:150', // Este es requerido porque es un campo clave
            'area_salud' => 'nullable|string',
            'distrito_salud' => 'nullable|string',
            'municipio' => 'nullable|string',
            'servicio_salud' => 'nullable|string',
            'responsable_informacion' => 'nullable|string',
            'cargo_responsable' => 'nullable|string',
            'anio' => 'nullable|string',
            'no_orden' => 'nullable|integer',
            'cui' => 'nullable|string', // Opcional en la actualización
            'fecha_nacimiento' => 'nullable|date',
            'sexo' => 'nullable|string|in:M,F', // Es requerido porque es clave para los datos
            'pueblo' => 'nullable|integer|in:1,2,3,4,5,6', // También es requerido en la actualización
            'comunidad_linguistica' => 'nullable|integer|in:1,2,3,...,23', // Opcional
            'escolaridad' => 'nullable|integer|in:0,1,2,3,4,5,6,7', // Opcional
            'profesion_oficio' => 'nullable|in:0,1,2,3,4,5,6,7,8',
            'discapacidad' => 'nullable|integer|in:0,1,2,3,4,5', // Opcional
            'orientacion_sexual' => 'nullable|integer|in:0,1,2,3,4,5', // Opcional
            'comunidad_direccion' => 'nullable|string', // Opcional
            'municipio_residencia' => 'nullable|string', // Opcional
            'agricola_migrante' => 'nullable|string',
            'embarazada' => 'nullable|string',
            'vacuna_mujer_15_49' => 'nullable|array', // Opcional
            'vacuna_mujer_15_49.*' => 'nullable|date', // Opcional
            'vacuna_otros_grupos' => 'nullable|array', // Opcional
            'vacuna_otros_grupos.*' => 'nullable|date', // Opcional
        ]);

        // Buscar el formulario
        $formulario = FormularioSIGSA5b::findOrFail($id);

        // Actualizar el formulario principal
        $formulario->update([
            'vacuna' => $validated['vacuna'] ?? $formulario->vacuna,
            'nombre_paciente' => $validated['nombre_paciente'], // Campo requerido
            'area_salud' => $validated['area_salud'] ?? null,
            'distrito_salud' => $validated['distrito_salud'] ?? null,
            'municipio' => $validated['municipio'] ?? null,
            'servicio_salud' => $validated['servicio_salud'] ?? null,
            'responsable_informacion' => $validated['responsable_informacion'] ?? null,
            'cargo_responsable' => $validated['cargo_responsable'] ?? null,
            'anio' => $validated['anio'] ?? null,
            'orientacion_sexual' => $validated['orientacion_sexual'] ?? null,
            'no_orden' => $validated['no_orden'] ?? null,
            'cui' => $validated['cui'] ?? null,
            'fecha_nacimiento' => $validated['fecha_nacimiento'] ?? null,
            'sexo' => $validated['sexo'] ?? null,
            'pueblo' => $validated['pueblo'] ?? null,
            'comunidad_linguistica' => $validated['comunidad_linguistica'] ?? null,
            'escolaridad' => $validated['escolaridad'] ?? null,
            'profesion_oficio' => $validated['profesion_oficio'] ?? null,
            'discapacidad' => $validated['discapacidad'] ?? null,
        ]);

        // Actualizar residencia
        $residencia = $formulario->residencia;
        if ($residencia) {
            $residencia->update([
                'comunidad_direccion' => $validated['comunidad_direccion'] ?? $residencia->comunidad_direccion,
                'municipio_residencia' => $validated['municipio_residencia'] ?? $residencia->municipio_residencia,
                'agricola_migrante' => $validated['agricola_migrante'] ?? $residencia->agricola_migrante,
                'embarazada' => $validated['embarazada'] ?? $residencia->embarazada,
            ]);
        } else {
            $formulario->residencia()->create([
                'comunidad_direccion' => $validated['comunidad_direccion'],
                'municipio_residencia' => $validated['municipio_residencia'],
                'agricola_migrante' => $validated['agricola_migrante'],
                'embarazada' => $validated['embarazada'],
            ]);
        }

        // Manejo de las dosis para Mujer de 15 a 49 años
        foreach (['1a', '2a', '3a', 'r1', 'r2'] as $dosis) {
            $fechaVacunacion = $request->input('vacuna_mujer_15_49.'.$dosis);

            // Busca la dosis existente
            $dosisExistente = $formulario->mujer15a49yOtrosGrupos()
                ->where('tipo_dosis', $dosis)
                ->where('grupo', 'mujer_15_49')
                ->first();

            if ($fechaVacunacion) {
                // Si hay una fecha, actualiza o crea la dosis
                if ($dosisExistente) {
                    $dosisExistente->fecha_vacunacion = $fechaVacunacion;
                    $dosisExistente->save();
                } else {
                    // Crea una nueva dosis si no existe
                    $formulario->mujer15a49yOtrosGrupos()->create([
                        'tipo_dosis' => $dosis,
                        'grupo' => 'mujer_15_49',
                        'fecha_vacunacion' => $fechaVacunacion,
                    ]);
                }
            } elseif ($dosisExistente) {
                // Si no hay fecha y existe la dosis, elimínala
                $dosisExistente->delete();
            }
        }

        // Manejo de las dosis para Otros Grupos
        foreach (['1a', '2a', '3a', 'r1', 'r2'] as $dosis) {
            $fechaVacunacion = $request->input('vacuna_otros_grupos.'.$dosis);

            // Busca la dosis existente
            $dosisExistente = $formulario->mujer15a49yOtrosGrupos()
                ->where('tipo_dosis', $dosis)
                ->where('grupo', 'otros_grupos')
                ->first();

            if ($fechaVacunacion) {
                // Si hay una fecha, actualiza o crea la dosis
                if ($dosisExistente) {
                    $dosisExistente->fecha_vacunacion = $fechaVacunacion;
                    $dosisExistente->save();
                } else {
                    // Crea una nueva dosis si no existe
                    $formulario->mujer15a49yOtrosGrupos()->create([
                        'tipo_dosis' => $dosis,
                        'grupo' => 'otros_grupos',
                        'fecha_vacunacion' => $fechaVacunacion,
                    ]);
                }
            } elseif ($dosisExistente) {
                // Si no hay fecha y existe la dosis, elimínala
                $dosisExistente->delete();
            }
        }


        // Redirigir de vuelta a la búsqueda si el término de búsqueda está presente
        $buscar = $request->input('buscar');
        if ($buscar) {
            return redirect()->route('busqueda.resultados', ['buscar' => $buscar])
                ->with('success', 'Formulario actualizado correctamente.');
        }


        // Redirigir al índice si no hay un término de búsqueda
        return redirect()->route('for-sigsa-5b.index')->with('success', 'Formulario actualizado correctamente');
    }

}
