<?php

namespace App\Http\Controllers;

use App\Models\Vacuna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VacunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mostrar una lista de todas las vacunas
        $vacunas = Vacuna::all();
        return view('vacunas.index', compact('vacunas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mostrar el formulario de creación de vacunas
        return view('vacunas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_vacuna' => ['required',
                'string',
                'max:255',
                'unique:vacunas,nombre_vacuna',
                'not_regex:/^\d+$/'
            ],
            'descripcion' => 'nullable|string|max:1000',
        ]);

        // Si no hay errores, guardar los datos en la base de datos
        Vacuna::create($request->only('nombre_vacuna', 'descripcion'));

        // Redirigir con un mensaje de éxito
        return redirect()->route('vacunas.create')->with('status', 'form-saved');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vacuna $vacuna)
    {
        // Mostrar un formulario de edición para una vacuna específica
        return view('vacunas.edit', compact('vacuna'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vacuna $vacuna)
    {
        $request->validate([
            'nombre_vacuna' => 'required|string|max:255|not_regex:/^\d+$/|unique:vacunas,nombre_vacuna,' . $vacuna->id,
            'descripcion' => 'nullable|string|max:1000',
        ]);

        // Actualizar los datos de la vacuna
        $vacuna->update($request->only('nombre_vacuna', 'descripcion'));

        // Redirigir a la lista con un mensaje de éxito
        return redirect()->route('vacunas.index')->with('success', 'Vacuna actualizada exitosamente.');
    }



    public function destroy(Vacuna $vacuna)
    {
        // Verificar si la vacuna está asociada a algún registro en formulario_sigsa_base o criterios_vacuna
        $asociadaFormulario = DB::table('formulario_sigsa_base')->where('vacuna', $vacuna->nombre_vacuna)->exists();
        $asociadaCriterios = DB::table('criterios_vacuna')->where('vacuna', $vacuna->nombre_vacuna)->exists();

        if ($asociadaFormulario || $asociadaCriterios) {
            return redirect()->route('vacunas.index')->withErrors(['error' => 'No se puede eliminar la vacuna porque está asociada a registros existentes.']);

        }

        // Si no hay registros asociados, eliminar la vacuna
        $vacuna->delete();

        // Redirigir a la lista de vacunas
        return redirect()->route('vacunas.index')->with('status', 'Vacuna eliminada exitosamente.');
    }


}
