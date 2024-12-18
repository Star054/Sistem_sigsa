<?php

namespace App\Http\Controllers;

use App\Models\FormularioSIGSA5b;
use App\Models\Modelo5bA;
use App\Models\TipoFormulario;
use App\Models\Consulta;
use App\Models\Vacuna;
use Illuminate\Http\Request;
use App\Models\Residencia;
use App\Models\Modelo3CS;
class FormularioController3CS extends Controller
{
    // Mostrar el formulario FOR-SIGSA-3CS (incluyendo la consulta)
    public function create()
    {
        $vacunas = Vacuna::all();
        return view('formularios.3CS', compact('vacunas'));
    }

    // Almacenar un nuevo formulario en la base de datos
    public function store(Request $request)
    {
        // Validar los datos generales del formulario y la consulta
        $validated = $request->validate([
            'codigo_formulario' => 'required|string',
            'area_salud' => 'nullable|string',
            'distrito_salud' => 'nullable|string',
            'municipio' => 'nullable|string',
            'servicio_salud' => 'nullable|string',
            'responsable_informacion' => 'nullable|string',
            'cargo_responsable' => 'nullable|string',
            'anio' => 'nullable|string',
            'dia_consulta' => 'nullable|date',
            'no_historia_clinica' => 'nullable|string',
            'nombre_paciente' => 'required|string|max:150',
            'fecha_nacimiento' => 'nullable|date',
            'cui' => 'nullable|string',
            'sexo' => 'nullable|string|in:M,F',
            'pueblo' => 'nullable|integer|in:1,2,3,4,5,6',
            'comunidad_linguistica' => 'nullable|integer|in:1,2,3,...,23',
            'escolaridad' => 'nullable|integer|in:0,1,2,3,4,5,6,7',
            'profesion_oficio' => 'nullable|in:0,1,2,3,4,5,6,7,8',
            'discapacidad' => 'nullable|integer|in:0,1,2,3,4,5',
            'orientacion_sexual' => 'nullable|integer|in:0,1,2,3,4,5',
            'comunidad_direccion' => 'nullable|string',
            'municipio_residencia' => 'nullable|string',
            'agricola_migrante' => 'nullable|string',
            'embarazada' => 'nullable|string',




            // Otros campos relacionados con la consulta
            'consulta' => 'nullable|in:1,2,3,4',
            'control' => 'nullable|in:0,1,2,3,4,5,6',
            'semana_gestacion' => 'nullable|integer|between:1,42',
            'viene' => 'nullable|in:0,1,2', // 0 - No aplica, 1 - Viene Referido, 2 - Viene Contra Referido
            'fue' => 'nullable|in:0,1,2', // 0 - No aplica, 1 - Fue Referido, 2 - Fue Contra Referido
            'referido_a' => 'nullable|string|max:255',
            'diagnostico' => 'nullable|string',
            'codigo_cie' => 'nullable|string|max:255',
            'tratamiento_descripcion' => 'required|exists:vacunas,nombre_vacuna',
            'tratamiento_presentacion' => 'nullable|numeric',
            'cantidad_recetada' => 'nullable|integer',
            'notificacion_lugar' => 'nullable|in:0,1,2,3',
            'notificacion_numero' => 'nullable|string|max:255',
            'nombre_acompanante' => 'nullable|string|max:255',



        ]);

        // Guardar el tipo de formulario en la tabla `tipo_formularios`
        $tipoFormulario = TipoFormulario::firstOrCreate([
            'codigo_formulario' => $validated['codigo_formulario'],
        ]);

        // Guardar directamente los datos generales en `formulario_sigsa_base`
        $formulario = Modelo3CS::create([
        'area_salud' => $validated['area_salud'] ?? null,
            'distrito_salud' => $validated['distrito_salud'] ?? null,
            'municipio' => $validated['municipio'] ?? null,
            'servicio_salud' => $validated['servicio_salud'] ?? null,
            'responsable_informacion' => $validated['responsable_informacion'] ?? null,
            'cargo_responsable' => $validated['cargo_responsable'] ?? null,
            'anio' => $validated['anio'],
            'dia_consulta' => $validated['dia_consulta'] ?? null,
            'no_historia_clinica' => $validated['no_historia_clinica'] ?? null,
            'nombre_paciente' => $validated['nombre_paciente'],
            'cui' => $validated['cui'],
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

           ]);


        // Establecer la relación en la tabla pivote con `tipo_formulario`
        $formulario->tiposFormulario()->attach($tipoFormulario->id);

        // Guardar los datos de Residencia
        $formulario->residencia()->create([
            'comunidad_direccion' => $validated['comunidad_direccion'],
            'municipio_residencia' => $validated['municipio_residencia'],
            'agricola_migrante' => $validated['agricola_migrante'] ?? null,
        ]);

        // Guardar los datos de Consulta
        Consulta::create([
            'formulario_sigsa_base_id' => $formulario->id,
            'consulta' => $validated['consulta'] ?? null,
            'control' => $validated['control'] ?? null,
            'semana_gestacion' => $validated['semana_gestacion'] ?? null,
            'referido_a' => $validated['referido_a'] ?? null,
            'diagnostico' => $validated['diagnostico'] ?? null,
            'codigo_cie' => $validated['codigo_cie'] ?? null,

            'viene' => $validated['viene'] ?? null,
            'fue' => $validated['fue'] ?? null,

            'tratamiento_descripcion' => $validated['tratamiento_descripcion'] ?? null,
            'tratamiento_presentacion' => $validated['tratamiento_presentacion'] ?? null,
            'cantidad_recetada' => $validated['cantidad_recetada'] ?? null,
            'notificacion_lugar' => $validated['notificacion_lugar'] ?? null,
            'notificacion_numero' => $validated['notificacion_numero'] ?? null,
            'nombre_acompanante' => $validated['nombre_acompanante'] ?? null,

        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('formularios-3cs.create')->with('status', 'Formulario y consulta guardados correctamente.');

    }

    public function index(Request $request)
    {
        // Obtener el mes y año desde los parámetros del formulario de filtrado
        $currentMonth = $request->input('mes', now()->month);  // Si no se proporciona un mes, se usa el mes actual
        $currentYear = $request->input('año', now()->year);     // Si no se proporciona un año, se usa el año actual

        // Obtener los formularios que corresponden al código FOR-SIGSA-3CS
        // y que tienen una fecha de consulta (dia_consulta) en el mes y año seleccionados
        $formularios = Modelo3CS::whereHas('tiposFormulario', function ($query) {
            $query->where('codigo_formulario', 'FOR-SIGSA-3CS');
        })
            ->whereMonth('dia_consulta', $currentMonth) // Filtrar por el mes de 'dia_consulta'
            ->whereYear('dia_consulta', $currentYear)   // Filtrar por el año de 'dia_consulta'
            ->with('consulta') // Cargar la relación de consultas
            ->get();

        return view('formularios.crud3CS.index', compact('formularios'));
    }




    public function edit($id)
    {
        // Obtener el formulario por ID junto con la relación de residencia y consulta
        $formulario = Modelo3CS::with('residencia', 'consulta')->findOrFail($id);

        // Obtener todas las vacunas disponibles
        $vacunas = Vacuna::all();

        // Pasar el formulario y las vacunas a la vista
        return view('formularios.crud3CS.edit', compact('formulario', 'vacunas'));
    }



    public function update(Request $request, $id)
    {
        // Validar los datos que pertenecen a la tabla formulario_sigsa_base
        $validated = $request->validate([

            'area_salud' => 'nullable|string',
            'distrito_salud' => 'nullable|string',
            'municipio' => 'nullable|string',
            'servicio_salud' => 'nullable|string',
            'responsable_informacion' => 'nullable|string',
            'cargo_responsable' => 'nullable|string',
            'anio' => 'nullable|string',
            'dia_consulta' => 'nullable|date',
            'no_historia_clinica' => 'nullable|string',
            'nombre_paciente' => 'required|string|max:150',
            'fecha_nacimiento' => 'nullable|date',
            'cui' => 'nullable|string',
            'sexo' => 'nullable|string|in:M,F',
            'pueblo' => 'nullable|integer|in:1,2,3,4,5,6',
            'comunidad_linguistica' => 'nullable|integer|in:1,2,3,...,23',
            'escolaridad' => 'nullable|integer|in:0,1,2,3,4,5,6,7',
            'profesion_oficio' => 'nullable|in:0,1,2,3,4,5,6,7,8',
            'discapacidad' => 'nullable|integer|in:0,1,2,3,4,5',

            'orientacion_sexual' => 'nullable|integer|in:0,1,2,3,4,5',
            'comunidad_direccion' => 'nullable|string',
            'municipio_residencia' => 'nullable|string',
            'agricola_migrante' => 'nullable|string',
            'embarazada' => 'nullable|string',


            // Validaciones para los campos de consulta
            'consulta.*' => 'nullable|in:1,2,3,4',
            'control.*' => 'nullable|in:0,1,2,3,4,5,6',
            'semana_gestacion.*' => 'nullable|integer|between:1,42',
            'viene.*' => 'nullable|in:0,1,2',
            'fue.*' => 'nullable|in:0,1,2',
            'referido_a.*' => 'nullable|string|max:255',
            'diagnostico.*' => 'nullable|string',
            'codigo_cie.*' => 'nullable|string|max:255',
            'tratamiento_descripcion.*' => 'required|exists:vacunas,nombre_vacuna',
            'tratamiento_presentacion.*' => 'nullable|numeric',
            'cantidad_recetada.*' => 'nullable|integer',
            'notificacion_lugar.*' => 'nullable|in:0,1,2,3',
            'notificacion_numero.*' => 'nullable|string|max:255',
            'nombre_acompanante.*' => 'nullable|string|max:255',
        ]);

        // Actualizar el formulario
        $formulario = Modelo3CS::findOrFail($id);
        $formulario->update([
            'area_salud' => $validated['area_salud'] ?? null,
            'distrito_salud' => $validated['distrito_salud'] ?? null,
            'no_orden' => $validated['no_orden'] ?? null,
            'municipio' => $validated['municipio'] ?? null,
            'servicio_salud' => $validated['servicio_salud'] ?? null,
            'responsable_informacion' => $validated['responsable_informacion'] ?? null,
            'cargo_responsable' => $validated['cargo_responsable'] ?? null,
            'anio' => $validated['anio'],
            'nombre_paciente' => $validated['nombre_paciente'],
            'cui' => $validated['cui'],
            'sexo' => $validated['sexo'] ?? null,
            'pueblo' => $validated['pueblo'] ?? null,
            'fecha_nacimiento' => $validated['fecha_nacimiento'] ?? null,
            'comunidad_linguistica' => $validated['comunidad_linguistica'] ?? null,
            'orientacion_sexual' => $validated['orientacion_sexual'] ?? null,


            'escolaridad' => $validated['escolaridad'] ?? null,
            'profesion_oficio' => $validated['profesion_oficio'] ?? null,
            'discapacidad' => $validated['discapacidad'] ?? null,
            'comunidad_direccion' => $validated['comunidad_direccion'] ?? null,
            'municipio_residencia' => $validated['municipio_residencia'] ?? null,
            'agricola_migrante' => $validated['agricola_migrante'] ?? null,

        ]);

        // Buscar el formulario por ID
        $formulario = Modelo3CS::findOrFail($id);

        // Actualizar los datos generales en `formulario_sigsa_base`
        $formulario->update($validated);

        // Actualizar o crear la relación en `residencia`
        if ($formulario->residencia) {
            // Si ya existe la residencia, actualizamos los datos
            $formulario->residencia->update([
                'comunidad_direccion' => $validated['comunidad_direccion'] ?? null,
                'municipio_residencia' => $validated['municipio_residencia'],
                'agricola_migrante' => $validated['agricola_migrante'] ?? null,
            ]);
        } else {
            // Si no existe, la creamos
            $formulario->residencia()->create([
                'comunidad_direccion' => $validated['comunidad_direccion'] ?? null,
                'municipio_residencia' => $validated['municipio_residencia'],
                'agricola_migrante' => $validated['agricola_migrante'] ?? null,
            ]);
        }

        // Actualizar o crear la relación en `consulta`
        if ($formulario->consulta && $formulario->consulta->isNotEmpty()) {
            // Iterar sobre cada consulta y actualizarla
            foreach ($formulario->consulta as $index => $consulta) {
                $consulta->update([
                    'consulta' => $validated['consulta'][$index] ?? null,
                    'control' => $validated['control'][$index] ?? null,
                    'semana_gestacion' => $validated['semana_gestacion'][$index] ?? null,
                    'referido_a' => $validated['referido_a'][$index] ?? null,
                    'diagnostico' => $validated['diagnostico'][$index] ?? null,
                    'codigo_cie' => $validated['codigo_cie'][$index] ?? null,

                    'viene' => $validated['viene'][$index] ?? null,
                    'fue' => $validated['fue'][$index] ?? null,

                    'tratamiento_descripcion' => $validated['tratamiento_descripcion'][$index] ?? null,
                    'tratamiento_presentacion' => $validated['tratamiento_presentacion'][$index] ?? null,
                    'cantidad_recetada' => $validated['cantidad_recetada'][$index] ?? null,
                    'notificacion_lugar' => $validated['notificacion_lugar'][$index] ?? null,
                    'notificacion_numero' => $validated['notificacion_numero'][$index] ?? null,
                    'nombre_acompanante' => $validated['nombre_acompanante'][$index] ?? null,
                ]);
            }
        } else {
            // Si no existen consultas, las creamos
            foreach ($validated['consulta'] as $index => $consultaData) {
                Consulta::create([
                    'formulario_sigsa_base_id' => $formulario->id,
                    'consulta' => $consultaData ?? null,
                    'control' => $validated['control'][$index] ?? null,
                    'semana_gestacion' => $validated['semana_gestacion'][$index] ?? null,
                    'referido_a' => $validated['referido_a'][$index] ?? null,
                    'diagnostico' => $validated['diagnostico'][$index] ?? null,
                    'codigo_cie' => $validated['codigo_cie'][$index] ?? null,

                    'viene' => $validated['viene'][$index] ?? null,
                    'fue' => $validated['fue'][$index] ?? null,
                    'tratamiento_descripcion' => $validated['tratamiento_descripcion'][$index] ?? null,
                    'tratamiento_presentacion' => $validated['tratamiento_presentacion'][$index] ?? null,
                    'cantidad_recetada' => $validated['cantidad_recetada'][$index] ?? null,
                    'notificacion_lugar' => $validated['notificacion_lugar'][$index] ?? null,
                    'notificacion_numero' => $validated['notificacion_numero'][$index] ?? null,
                    'nombre_acompanante' => $validated['nombre_acompanante'][$index] ?? null,
                ]);
            }
        }

        // Redirigir con un mensaje de éxito
        return redirect()->route('formularios-3cs.index')->with('status', 'Formulario actualizado correctamente.');
    }



    public function destroy($id)
    {
        // Buscar el formulario por ID
        $formulario = Modelo3CS::findOrFail($id);

        // Eliminar la residencia y la consulta si existen
        if ($formulario->residencia) {
            $formulario->residencia()->delete();
        }
        if ($formulario->consulta) {
            $formulario->consulta()->delete();
        }

        // Eliminar el formulario
        $formulario->delete();

        // Redirigir con mensaje de éxito
        return redirect()->route('formularios-3cs.index')->with('status', 'Formulario eliminado correctamente.');
    }
}
