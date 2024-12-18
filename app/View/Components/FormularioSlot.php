<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Vacuna;  // Importa el modelo de Vacuna

class FormularioSlot extends Component
{
    public $codigo;
    public $version;
    public $vigencia;
    public $vacunas;  // Variable para almacenar las vacunas

    /**
     * Create a new component instance.
     */
    public function __construct($codigo = 'FOR-SIGSA-Default', $version = '1.0', $vigencia = 'No Definido')
    {
        $this->codigo = $codigo;
        $this->version = $version;
        $this->vigencia = $vigencia;

        // Obtener las vacunas desde la base de datos
        $this->vacunas = Vacuna::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.formulario-slot', ['vacunas' => $this->vacunas]);
    }
}
