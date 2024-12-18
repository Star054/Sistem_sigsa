<?php

namespace App\Http\Controllers;

use App\Models\TipoFormulario;
use Illuminate\Http\Request;

class TipoFormularioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Aquí podrías devolver una lista de todos los tipos de formularios si es necesario.
        $tiposFormulario = TipoFormulario::all();
        return view('tipo_formulario.index', compact('tiposFormulario'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Muestra el formulario para crear un nuevo tipo de formulario
        return view('tipo_formulario.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $validated = $request->validate([
            'codigo_formulario' => 'required|string|max:255|unique:tipo_formulario,codigo_formulario',
            'descripcion' => 'nullable|string|max:1000',
        ]);

        // Crear el nuevo tipo de formulario
        TipoFormulario::create($validated);

        // Redirigir al formulario con un mensaje de éxito
        return redirect()->route('tipo_formulario.create')->with('success', 'Tipo de formulario creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoFormulario $tipoFormulario)
    {
        // Mostrar detalles de un tipo de formulario específico
        return view('tipo_formulario.show', compact('tipoFormulario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoFormulario $tipoFormulario)
    {
        // Muestra el formulario para editar un tipo de formulario
        return view('tipo_formulario.edit', compact('tipoFormulario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoFormulario $tipoFormulario)
    {
        // Validación de los datos actualizados
        $validated = $request->validate([
            'codigo_formulario' => 'required|string|max:255|unique:tipo_formulario,codigo_formulario,' . $tipoFormulario->id,
            'descripcion' => 'nullable|string|max:1000',
        ]);

        // Actualizar el tipo de formulario
        $tipoFormulario->update($validated);

        // Redirigir con un mensaje de éxito
        return redirect()->route('tipo_formulario.index')->with('success', 'Tipo de formulario actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoFormulario $tipoFormulario)
    {
        // Eliminar el tipo de formulario
        $tipoFormulario->delete();

        // Redirigir con un mensaje de éxito
        return redirect()->route('tipo_formulario.index')->with('success', 'Tipo de formulario eliminado exitosamente.');
    }
}
